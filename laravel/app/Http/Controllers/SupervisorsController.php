<?php

namespace App\Http\Controllers;

use DB;

use App\Student;
use App\Staff;
use App\Supervisor;
use App\User;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\HttpResponse;
use Auth;

class SupervisorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $supervisors = Supervisor::with('staff.user', 'student.user')->get();

        return view('entities.supervisors.index', compact('supervisors'));
    }

    public function create()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  string  $enrolment
     * @return Create new supervisor record view
     */
    public function createForStudent($enrolment)
    {
        $student = Student::with('user')->where('enrolment', $enrolment)->firstOrFail();

        $staffUsers = User::with('staff')->where('account_type', 'Staff')->get();

        $staffList = $staffUsers->lists('full_name', 'staff.id');

        return view('entities.supervisors.create', compact('student', 'staffList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function storeForStudent(Request $request)
    {
        //return $request->student_id;
        if ($request->end == '0000-00-00' || $request->end == '') {
            $request->end = NULL;
        }
        $this->validate($request, [
            'staff_id' => 'integer|required',
            'student_id' => 'integer|required',
            'start' => 'date|required',
            'end' => 'date|after:start',
            'order' => 'integer|required|max:8']);

        $student = Student::with('user')->where('id', $request->student_id)->firstOrFail();

        $staff = Staff::with('user')->where('id', $request->staff_id)->firstOrFail();

        $newSupervisor = Supervisor::create([
            'student_id' => $student->id,
            'staff_id' => $staff->id,
            'order' => $request->order,
            'start' => $request->start,
            'end' => $request->end]);

        $newHistoryContent = "Supervisor: ".$staff->user->full_name."\nOrder: ".$newSupervisor->order."\nStart: ".$newSupervisor->start;

        if ($newSupervisor->end) {
            $newHistoryContent = $newHistoryContent."\nEnd: ".$newSupervisor->end;
        }

        $newAutoHistory = new \App\Libraries\systemHistory;
        $newAutoHistory->create($student->id, 'New supervisor added', $newHistoryContent);

        return redirect()->action('StudentsController@show', ['enrolment' => $student->enrolment])->with('success_message', 'Successfully added new supervision record');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $supervisor = Supervisor::with('student.user', 'staff.user')->where('id', $id)->firstOrFail();
        
        return view('entities.supervisors.show', compact('supervisor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $staffUsers = User::with('staff')->where('account_type', 'Staff')->get();

        $staffList = $staffUsers->lists('full_name', 'staff.id');

        $supervisor = Supervisor::with('student.user', 'staff.user')->where('id', $id)->firstOrFail();
        
        return view('entities.supervisors.edit', compact('supervisor', 'staffList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'staff_id' => 'integer|required',
            'start' => 'date|required',
            'end' => 'date|after:start',
            'order' => 'integer|required|max:999999']);

        $supervisor = Supervisor::with('student.user', 'staff.user')->where('id', $id)->firstOrFail();

        $supervisor->update($request->all());

        //ensure end date is set to NULL if no date is entered
        if ($request->end == '0000-00-00' || $request->end == '') {
            $supervisor->end = NULL;
            $supervisor->save();
        }

        $updatedHistoryContent = "Supervisor: ".$supervisor->staff->user->full_name."\nOrder: ".$supervisor->order."\nStart: ".$supervisor->start;

        if ($supervisor->end) {
            $updatedHistoryContent = $updatedHistoryContent."\nEnd: ".$supervisor->end;
        }

        $newAutoHistory = new \App\Libraries\systemHistory;
        $newAutoHistory->create($supervisor->student->id, 'Updated supervisor record', $updatedHistoryContent);

        return redirect()->action('StudentsController@show', ['enrolment' => $supervisor->student->enrolment])->with('success_message', 'Successfully updated existing supervision record');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $supervisor = Supervisor::find($id);
        $enrolment = $supervisor->student->enrolment;
        $supervisor->delete();
        return redirect()->action('StudentsController@show', ['enrolment' => $enrolment])->with('success_message', 'Successfully removed supervision record');
    }
}
