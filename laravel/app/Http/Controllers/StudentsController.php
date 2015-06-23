<?php

namespace App\Http\Controllers;

use Request;

use App\User;
use App\Student;
use App\Award;
use App\Funding;
use App\UK_BA_Status;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Input;
use Session;
use Redirect;

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
        $rules = array(
            'title' => 'string',
            'first_name' => 'required|string',
            'middle_name' => 'string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'personal_email' => 'email',
            'personal_phone' => 'string',
            'home_address' => 'required',
            'nationality' => 'required|string',
            'start' => 'required|date',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the input
        if ($validator->fails()) {
            return Redirect::to('students/create')
                ->withErrors($validator);
        } else {
            // store
            $newUser = new User;
            $newUser->title = Input::get('title');
            $newUser->first_name = Input::get('first_name');
            $newUser->middle_name = Input::get('middle_name');
            $newUser->last_name = Input::get('last_name');
            $newUser->email = Input::get('email');
            $newUser->personal_email = Input::get('personal_email');
            $newUser->personal_phone = Input::get('personal_phone');
            $newUser->account_type = 'Student';
            $newUser->save();

            $studentData = array(
                'dob' => Input::get('dob'),
                'enrolment' => Input::get('enrolment'),
                'gender' => Input::get('gender'),
                'home_address' => Input::get('home_address'),
                'current_address' => Input::get('current_address'),
                'nationality' => Input::get('nationality'),
                'start' => Input::get('start'),
                'uk_ba_status' => '1',
                'funding_id' => '1',
                'award_id' => '1',
                'award_type_id' => '1',
                'enrolment_status_id' => '1',
            );
            $newStudent = $newUser->student()->create($studentData);

            // redirect to new student's profile
            Session::flash('message', 'Successfully created student');

            $student = Student::with('user')->where('enrolment', Input::get('enrolment'))->firstOrFail();

            return view('staff.pages.students.show', compact('student'));
        }

        $input = Request::all();

        //dd($input);

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
