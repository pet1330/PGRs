<?php

namespace App\Http\Controllers;

use App\Event;
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
        return view('staff.pages.students.event.create', compact('student'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $request['staff_id'] = Auth::user()->id;

        $this->validate($request, [
            'staff_id' => 'integer|required|exists:staff,id',
            'student_id' => 'integer|required|exists:students,id',
            'title' => 'string|required',
            'content' => 'max:65000',
            'created' => 'date|required']);

        $staff = Staff::with('user')->where('id', $request->staff_id)->firstOrFail();

        $student = Student::with('user')->where('id', $request->student_id)->firstOrFail();

        $newEvent = Event::create([
            'student_id' => $student->id,
            'staff_id' => $staff->id,
            'created_by' => $staff->user->account_type,
            'title' => $request->title,
            'content' => $request->content,
            'created' => $request->created]);

        return redirect()->action('StudentsController@show', ['enrolment' => $student->enrolment])->with('success_message', 'Successfully added new supervision record');    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {

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
    public function destroy($enrolment, $id)
    {
        $event = Event::with('student')->find($id);
        $eventName = $event->title;
        $enrolment = $event->student->enrolment;
        $event->delete();
        return redirect()->action('StudentsController@show', ['enrolment' => $enrolment])->with('success_message', 'Successfully removed event: '.$eventName);
    }
}
