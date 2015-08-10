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

        $gsFormsApprovedEnabled = $gsForms->lists('approved_enabled', 'id');

        $staffUsers = User::with('staff')->whereHas('roles', function($q) {
            $q->where('name', 'staff');
        })->get();

        $staffList = $staffUsers->lists('full_name', 'staff.id')->all();

        $currentDirectorOfStudyId = $student->currentSupervisorId(1);
        $currentSecondSupervisorId = $student->currentSupervisorId(2);
        $currentThirdSupervisorId = $student->currentSupervisorId(3);

        return view('entities.students.events.create', compact('student', 'gsFormsList', 'gsFormsApprovedEnabled', 'staffList', 'currentDirectorOfStudyId', 'currentSecondSupervisorId', 'currentThirdSupervisorId'));
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
            'created_at' => 'date|required',
            'submitted_at' => 'date',
            'approved_at' => 'date',
            'comments' => 'max:65000',
            'director_of_study_id' => 'integer|required|exists:staff,id',
            'second_supervisor_id' => 'integer|different:director_of_study_id|different:third_supervisor_id|exists:staff,id',
            'third_supervisor_id' => 'integer|different:director_of_study_id|exists:staff,id',
            ]);

        $request['created_at'] = Carbon::parse($request['created_at']);

        //set supervisors to null if not entered
        if (!is_numeric($request['second_supervisor_id'])) {
            $request['second_supervisor_id'] = NULL;
        }
        if (!is_numeric($request['third_supervisor_id'])) {
            $request['third_supervisor_id'] = NULL;
        }

        $student = Student::with('user')->where('id', $request->student_id)->firstOrFail();

        $gs_form = GS_Form::where('id', $request->gs_form_id)->firstOrFail();

        // for GS Forms with auto calculated start and end dates
        if ($gs_form->defaultStartMonth) {
            //calculate expected start date
            $request['start'] = Carbon::parse($student->start)->addMonths($gs_form->defaultStartMonth)->subDays(Setting::get('defaultEventDuration'));

            //calculate expected end date
            $request['end'] = Carbon::parse($student->start)->addMonths($gs_form->defaultStartMonth)->addDays(Setting::get('defaultEventDuration'));
        }

        if ($request->submitted_at == '') {
            $request['submitted_at'] = NULL;
        }

        if ($request->approved_at == '' || !$gs_form->approved_enabled) {
            $request['approved_at'] = NULL;
        }

        $request['student_id'] = $student->id;

        $newEvent = Event::create($request->all());

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
        $this->validate($request, [
            'created_at' => 'required|date',
            'submitted_at' => 'date',
            'approved_at' => 'date',
            'start' => 'date',
            'end' => 'date|after:start',
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

        if ($request->submitted_at == '') {
            $request['submitted_at'] = NULL;
        }

        if ($request->approved_at == '') {
            $request['approved_at'] = NULL;
        }

        if ($request->start == '') {
            $request['start'] = NULL;
        }

        if ($request->end == '') {
            $request['end'] = NULL;
        }

        $event->update($request->all());

        return redirect()->action('StudentsController@show', ['enrolment' => $event->student->enrolment])->with('success_message', 'Successfully updated <a href="'.action('EventsController@show', ['enrolment' => $event->student->enrolment, 'id' => $event->id]).'" class="alert-link">'.$event->gs_form->name.'</a>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $enrolment
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

    /**
     * Show all upcoming events for all current students.
     *
     * @return Response
     */
    public function upcomingIndex()
    {
        $upcoming_events = Event::with('student.user', 'directorOfStudy.user', 'secondSupervisor.user', 'thirdSupervisor.user', 'gs_form')->whereNull('submitted_at')->whereNull('approved_at')->whereRaw('start <= DATE_ADD(NOW(), INTERVAL '.Setting::get('upcomingEventsTimeFrame').' MONTH) AND start >= NOW()')->get();

        return view('entities.students.events.upcomingIndex', compact('upcoming_events'));
    }
}
