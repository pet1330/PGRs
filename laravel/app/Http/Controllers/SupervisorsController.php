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

        return view('staff.pages.supervisors.index', compact('supervisors'));
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

        return view('staff.pages.supervisors.create', compact('student', 'staffList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function storeForStudent(Request $request)
    {
        if ($request->end == '0000-00-00' || $request->end == '') {
            $request->end = NULL;
        }
        //return $request->all();
        $this->validate($request, [
            'staff_id' => 'integer|required',
            'enrolment' => 'string|required',
            'start' => 'date|required',
            'end' => 'date',
            'order' => 'integer|required|max:999999']);

        $student = Student::with('user')->where('enrolment', $request->enrolment)->firstOrFail();

        $staff = Staff::with('user')->where('id', $request->staff_id)->firstOrFail();

        $newSupervisor = Supervisor::create([
            'student_id' => $student->id,
            'staff_id' => $staff->id,
            'order' => $request->order,
            'start' => $request->start,
            'end' => $request->end]);

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
        
        return view('staff.pages.supervisors.show', compact('supervisor'));
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
        $supervisor = Supervisor::find($id);
        $supervisor->delete();
        return redirect()->action('SupervisorsController@index')->with('info_message', 'Successfully removed supervision record');
    }
}
