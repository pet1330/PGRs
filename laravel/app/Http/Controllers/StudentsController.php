<?php

namespace App\Http\Controllers;

use DB;
use App\Award;
use App\Award_Type;
use App\Enrolment_Status;
use App\Funding_Type;
use App\Student;
use App\UKBA_Status;
use App\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\HttpResponse;

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
        $award_types = Award_Type::lists('name', 'id');
        $awards = Award::lists('name', 'id');
        $enrolment_statuses = Enrolment_Status::lists('name', 'id');
        $funding_types = Funding_Type::lists('name', 'id');
        $ukba_status = UKBA_Status::lists('name', 'id');

        return view('staff.pages.students.create', compact('award_types', 'awards', 'enrolment_statuses', 'funding_types', 'ukba_status'));
    }

    /**
     * Store a newly created student in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        // student user rules
        $studentRules = array(
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
            'enrolment' => 'required|unique:students',
            'ukba_status_id' => 'required',
            'funding_type_id' => 'required',
            'award_id' => 'required',
            'award_type_id' => 'required',
            'enrolment_status_id' => 'required',
            );

        $this->validate($request, $studentRules);

        $newUser = User::create($request->all());

        $newStudent = $newUser->student()->create($request->all());

        return redirect()->action('StudentsController@show', ['enrolment' => $newStudent->enrolment])->with('success_message', 'Successfully added new student: '.$request->first_name.' '.$request->last_name);
    }

    /**
     * Return the specified student via their enrolment number.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($enrolment)
    {
        $student = Student::with('user')->where('enrolment', $enrolment)->firstOrFail();
        
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
        $award_types = Award_Type::lists('name', 'id');
        $awards = Award::lists('name', 'id');
        $enrolment_statuses = Enrolment_Status::lists('name', 'id');
        $funding_types = Funding_Type::lists('name', 'id');
        $ukba_status = UKBA_Status::lists('name', 'id');

        $student = Student::with('user')->where('enrolment', $enrolment)->firstOrFail();

        return view('staff.pages.students.edit', compact('student', 'award_types', 'awards', 'enrolment_statuses', 'funding_types', 'ukba_status'));
    }

    /**
     * Update the specified student in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $student_id)
    {
        $user_id = Student::with('user')->where('id', $student_id)->firstOrFail()->user_id;
        // student user rules
        $studentRules = array(
            'title' => 'string',
            'first_name' => 'required|string',
            'middle_name' => 'string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$user_id,
            'personal_email' => 'email',
            'personal_phone' => 'string',
            'home_address' => 'required',
            'nationality' => 'required|string',
            'start' => 'required|date',
            'enrolment' => 'required|unique:students,enrolment,'.$student_id,
            'ukba_status_id' => 'required',
            'funding_type_id' => 'required',
            'award_id' => 'required',
            'award_type_id' => 'required',
            'enrolment_status_id' => 'required',
            );

        $this->validate($request, $studentRules);

        $student = Student::with('user')->where('id', $student_id)->firstOrFail();

        DB::transaction(function() use ($request, $student)
        {
            try {
                $student->update($request->all());

                $user = $student->user()->update($request->all());
            } catch (\Exception $e) {
                DB::rollback();
                    // something went wrong
                return redirect()->action('StudentsController@show', ['enrolment' => $student->enrolment])->with('danger_message', 'Failed to update this student');
            }
        });

        return redirect()->action('StudentsController@show', ['enrolment' => $student->enrolment])->with('success_message', 'Successfully updated this student');
    }

    /**
     * Remove the student resource from storage.
     *
     * @param  string  $enrolment
     * @return redirect to student index
     */
    public function destroy($enrolment)
    {
        $student = Student::with('user')->where('enrolment', $enrolment)->firstOrFail();

        $removedStudentName = $student->user->first_name.' '.$student->user->last_name;

        DB::transaction(function() use ($enrolment, $student, $removedStudentName)
        {
            try {
                $student->delete();

                $student->user()->delete();
            } catch (\Exception $e) {
                DB::rollback();
                // something went wrong
                return redirect()->action('StudentsController@index')->with('danger_message', 'There was an error removing the student'.$removedStudentName);
            }
        });
        return redirect()->action('StudentsController@index')->with('info_message', 'Successfully removed student: '.$removedStudentName);
    }
}