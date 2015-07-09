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

        $gsFormsList = $gsForms->lists('name', 'id');

        $staffUsers = User::with('staff')->where('account_type', 'Staff')->get();

        $staffList = $staffUsers->lists('full_name', 'staff.id')->all();

        return view('staff.pages.students.events.create', compact('student', 'gsFormsList', 'staffList'));
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
            'submitted' => 'date|required',
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

        $newEvent = Event::create([
            'student_id' => $student->id,
            'gs_form_id' => $request->gs_form_id,
            'submitted' => $request->submitted,
            'comments' => $request->comments,
            'director_of_study_id' => $request->director_of_study_id,
            'second_supervisor_id' => $request->second_supervisor_id,
            'third_supervisor_id' => $request->third_supervisor_id]);

        return redirect()->action('StudentsController@show', ['enrolment' => $student->enrolment])->with('success_message', 'Successfully added new event');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
