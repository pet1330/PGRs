<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Student;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class StudentsController extends Controller
{
    /**
     * Get all users who are students.
     *
     * @return Response
     */
    public function index()
    {
        $students = User::with('student')->get();

        return view('staff.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
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
     * Return the specified student via their enrolment number.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($enrolment)
    {
        $student = Student::with('user')->where('enrolment', $enrolment)->first();
        
        return view('staff.students.show', compact('student'));
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
