<?php

namespace App\Http\Controllers;

use Request;

use App\User;
use App\Student;
use App\Level;
use App\Funding;
use App\UK_BA_Status;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class StudentsController extends Controller
{
    /**
     * Show all students.
     *
     * @return Response
     */
    public function index()
    {
        $students = Student::with('user')->get();

        return view('staff.pages.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new student.
     *
     * @return Response
     */
    public function create()
    {
        return view('staff.pages.students.create');
    }

    /**
     * Store a newly created student in storage.
     *
     * @return Response
     */
    public function store()
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        // $rules = array(
        //     'first_name' => 'required',
        //     'last_name' => 'required',
        //     'email' => 'required|email',
        // );
        // $validator = Validator::make(Input::all(), $rules);

        // // process the input
        // if ($validator->fails()) {
        //     return Redirect::to('students/create')
        //         ->withErrors($validator);
        // } else {
        //     // store
        //     // $student = new User;
        //     // $student->first_name       = Input::get('first_name');
        //     // $student->last_name      = Input::get('last_name');
        //     // $student->email = Input::get('email');
        //     // $student->save();

        //     // redirect
        //     Session::flash('message', 'Successfully created student');
        //     return Redirect::to('students');
        // }

        $input = Request::all();

        dd($input);

        return $input;
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
        
        return view('staff.pages.students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified student.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($enrolment)
    {
        $student = Student::with('user')->where('enrolment', $enrolment)->first();
        
        return view('staff.pages.students.edit', compact('student'));
    }

    /**
     * Update the specified student in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the student resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
