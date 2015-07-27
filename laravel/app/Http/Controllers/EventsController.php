<?php

namespace App\Http\Controllers;

use App\Event;
use App\GS_Form;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Student;
use App\Staff;
use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\HttpResponse;
use Input;
use Redirect;
use Session;
use Validator;
use Carbon\Carbon;
use Setting;
use Zizaco\Entrust\Traits\EntrustUserTrait;

use Entrust;

class EventsController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request, $enrolment)
    {
        $student = Student::with('user')->where('enrolment', $enrolment)->firstOrFail();

        $gsForms = GS_Form::get();

        $gsFormsList = $gsForms->lists('name_and_description', 'id');

        $staffUsers = User::with('staff')->whereHas('roles', function($q) {
            $q->where('name', 'staff');
        })->get();

        $staffList = $staffUsers->lists('full_name', 'staff.id')->all();

        return view('entities.students.events.create', compact('student', 'gsFormsList', 'staffList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request, $enrolment)
    {
        $this->validate($request, [
            'gs_form_id' => 'integer|required|exists:gs_forms,id',
            'exp_start' => 'date',
            'exp_end' => 'date',
            'submitted_at' => 'date',
            'approved_at' => 'date',
            'comments' => 'max:65000',
            'director_of_study_id' => 'integer|required|exists:staff,id',
            'second_supervisor_id' => 'integer|different:director_of_study_id|different:third_supervisor_id|exists:staff,id',
            'third_supervisor_id' => 'integer|different:director_of_study_id|exists:staff,id',
            ]);

        //set supervisors to null if not entered
        if (!is_numeric($request['second_supervisor_id'])) {
            $request['second_supervisor_id'] = NULL;
        }
        if (!is_numeric($request['third_supervisor_id'])) {
            $request['third_supervisor_id'] = NULL;
        }

        $student = Student::with('user')->where('id', $request->student_id)->firstOrFail();

        $gs_form = GS_Form::where('id', $request->gs_form_id)->firstOrFail();

        //default time is normal, aka x1
        $timeCalcFactor = 1;

        //if the student is part time, their event times will be multiplied by 1.5
        if ($student->mode_of_study_id == 2) {
            $timeCalcFactor = Setting::get('partTimeDefaultStudyDurationMultiplier');
        }

        //for events that have an expected duration
        if ($gs_form->defaultDuration) {
            //calculate expected start date

            $request['exp_start'] = Carbon::parse($student->start)->addMonths($gs_form->defaultStartMonth * $timeCalcFactor);

            //calculate expected end date

            $request['exp_end'] = Carbon::parse($request['exp_start'])->addMonths($gs_form->defaultDuration * $timeCalcFactor);
        }
        //for events that have an expected date but not a duration
        elseif ($gs_form->defaultDuration == NULL && $gs_form->defaultStartMonth) {
            //calculate expected event date

            $request['exp_start'] = Carbon::parse($student->start)->addMonths($gs_form->defaultStartMonth * $timeCalcFactor);
            $request['exp_end'] = NULL;
        }
        else {
            //set calculated dates to NULL if dates not known for GS form
            $request['exp_start'] = NULL;
            $request['exp_end'] = NULL;
        }

        if ($request->submitted_at == '') {
            $request['submitted_at'] = NULL;
        }

        if ($request->approved_at == '') {
            $request['approved_at'] = NULL;
        }

        $newEvent = Event::create([
            'student_id' => $student->id,
            'gs_form_id' => $request->gs_form_id,
            'submitted_at' => $request->submitted_at,
            'approved_at' => $request->approved_at,
            'comments' => $request->comments,
            'director_of_study_id' => $request->director_of_study_id,
            'second_supervisor_id' => $request->second_supervisor_id,
            'third_supervisor_id' => $request->third_supervisor_id,
            'exp_start' => $request->exp_start,
            'exp_end' => $request->exp_end]);

        return redirect()->action('StudentsController@show', ['enrolment' => $student->enrolment])->with('success_message', 'Successfully added new <a href="'.action('EventsController@show', ['enrolment' => $newEvent->student->enrolment, 'id' => $newEvent->id]).'" class="alert-link">'.$newEvent->gs_form->name.'</a> event');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($enrolment, $id)
    {
        $event = Event::with('gs_form', 'student.user', 'directorOfStudy.user', 'secondSupervisor.user', 'thirdSupervisor.user')->where('id', $id)->firstOrFail();

        return view('entities.students.events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($enrolment, $id)
    {
        $event = Event::with('gs_form', 'student.user', 'directorOfStudy.user', 'secondSupervisor.user', 'thirdSupervisor.user')->where('id', $id)->firstOrFail();

        $staffUsers = User::with('staff')->whereHas('roles', function($q) {
            $q->where('name', 'staff');
        })->get();

        $staffList = $staffUsers->lists('full_name', 'staff.id')->all();

        return view('entities.students.events.edit', compact('event', 'staffList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $enrolment, $id)
    {
        if ($request['auto_calculate_disabled'] != 1) {
            $request['auto_calculate_disabled'] = 0;   
        }

        $this->validate($request, [
            'exp_start' => 'date',
            'exp_end' => 'date',
            'created_at' => 'required|date',
            'submitted_at' => 'date',
            'approved_at' => 'date',
            'exp_start' => 'date',
            'exp_end' => 'date',
            'auto_calculate_disabled' => 'boolean',
            'comments' => 'max:65000',
            'director_of_study_id' => 'integer|required|exists:staff,id',
            'second_supervisor_id' => 'integer|different:director_of_study_id|different:third_supervisor_id|exists:staff,id',
            'third_supervisor_id' => 'integer|different:director_of_study_id|exists:staff,id',
            ]);

        //set supervisors to null if not entered
        if (!is_numeric($request['second_supervisor_id'])) {
            $request['second_supervisor_id'] = NULL;
        }
        if (!is_numeric($request['third_supervisor_id'])) {
            $request['third_supervisor_id'] = NULL;
        }

        $request['created_at'] = Carbon::parse($request['created_at']);

//get existing event
        $event = Event::with('gs_form', 'student.user', 'directorOfStudy.user', 'secondSupervisor.user', 'thirdSupervisor.user')->where('id', $id)->firstOrFail();

        if ($request->auto_calculate_disabled == 0) {
//default time is normal, aka x1
            $timeCalcFactor = 1;

//if the student is part time, their event times will be multiplied by 1.5
            if ($event->student->mode_of_study_id == 2) {
                $timeCalcFactor = Setting::get('partTimeDefaultStudyDurationMultiplier');
            }

//for events that have an expected duration
            if ($event->gs_form->defaultDuration) {
//calculate expected start date

                $request['exp_start'] = Carbon::parse($event->student->start)->addMonths($event->gs_form->defaultStartMonth * $timeCalcFactor);

//calculate expected end date

                $request['exp_end'] = Carbon::parse($request['exp_start'])->addMonths($event->gs_form->defaultDuration * $timeCalcFactor);
            }
//for events that have an expected date but not a duration
            elseif ($event->gs_form->defaultDuration == NULL && $event->gs_form->defaultStartMonth) {
//calculate expected event date

                $request['exp_start'] = Carbon::parse($event->student->start)->addMonths($event->gs_form->defaultStartMonth * $timeCalcFactor);
                $request['exp_end'] = NULL;
            }
            else {
//set calculated dates to NULL if dates not known for GS form
                $request['exp_start'] = NULL;
                $request['exp_end'] = NULL;
            }
        }

        if ($request->submitted_at == '') {
            $request['submitted_at'] = NULL;
        }

        if ($request->approved_at == '') {
            $request['approved_at'] = NULL;
        }

        if ($request->exp_start == '') {
            $request['exp_start'] = NULL;
        }

        if ($request->exp_end == '') {
            $request['exp_end'] = NULL;
        }

        $event->update($request->all());

        return redirect()->action('StudentsController@show', ['enrolment' => $event->student->enrolment])->with('success_message', 'Successfully updated <a href="'.action('EventsController@show', ['enrolment' => $event->student->enrolment, 'id' => $event->id]).'" class="alert-link">'.$event->gs_form->name.'</a>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($enrolment, $id)
    {
        $event = Event::with('gs_form')->where('id', $id)->firstOrFail();
        $event->delete();
        if ($event->approved_at) {
            return redirect()->action('StudentsController@show', ['enrolment' => $enrolment])->with('success_message', 'Successfully removed '.$event->gs_form->name.' event record originally approved on '.$event->approved_at);
        }
        else {
            return redirect()->action('StudentsController@show', ['enrolment' => $enrolment])->with('success_message', 'Successfully removed '.$event->gs_form->name.' event');
        }
    }
}
