<?php

namespace App\Http\Controllers;

use App\History;
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

class HistoryController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request, $enrolment)
    {
        $student = Student::with('user')->where('enrolment', $enrolment)->firstOrFail();
        return view('entities.students.history.create', compact('student'));
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

        $newHistory = History::create([
            'student_id' => $student->id,
            'staff_id' => $staff->id,
            'created_by' => 'Staff',
            'title' => $request->title,
            'content' => $request->content,
            'created' => $request->created]);

        return redirect()->action('StudentsController@show', ['enrolment' => $student->enrolment])->with('success_message', 'Successfully added new history: '.$newHistory->title);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($enrolment, $id)
    {
        $staffUsers = User::with('staff')->get();

        $staffList = $staffUsers->lists('full_name', 'staff.id');

        $history = History::with('student', 'staff')->where('id', $id)->firstOrFail();
        return view('entities.students.history.edit', compact('history', 'staffList'));
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
            'staff_id' => 'integer|required|exists:staff,id',
            'student_id' => 'integer|required|exists:students,id',
            'title' => 'string|required',
            'content' => 'max:65000',
            'created' => 'date|required']);

        $staff = Staff::with('user')->where('id', $request->staff_id)->firstOrFail();

        $student = Student::with('user')->where('id', $request->student_id)->firstOrFail();

        $history = History::with('student.user', 'staff.user')->where('id', $id)->firstOrFail();

        $request['created_by'] = 'Staff';

        $history->update($request->all());

        return redirect()->action('StudentsController@show', ['enrolment' => $student->enrolment])->with('success_message', 'Successfully updated history: '.$history->title);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($enrolment, $id)
    {
        $history  = History::with('student')->find($id);
        $historyTitle = $history->title;
        $enrolment = $history->student->enrolment;
        $history->delete();
        return redirect()->action('StudentsController@show', ['enrolment' => $enrolment])->with('success_message', 'Successfully removed history: '.$historyTitle);
    }
}
