<?php

namespace App\Http\Controllers;

use App\Award;
use App\Course;
use App\Enrolment_Status;
use App\History;
use App\Funding_Type;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\CreateStudentRequest;
use App\Mode_Of_Study;
use App\Student;
use App\Supervisor;
use App\UKBA_Status;
use App\User;
use App\Event;
use App\GS_Form;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\HttpResponse;
use Input;
use Redirect;
use Session;
use Validator;
use File;
use Carbon\Carbon;

use Entrust;

use Setting;

class StudentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show all students.
     *
     * @return Response
     */
    public function index()
    {
        $students = Student::with('user', 'supervisors.staff.user')->get();

        return view('entities.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new student.
     *
     * @return Response
     */
    public function create()
    {
        $awards = Award::lists('name', 'id');
        $courses = Course::lists('name', 'id');
        $enrolment_statuses = Enrolment_Status::lists('name', 'id');
        $funding_types = Funding_Type::lists('name', 'id');
        $modes_of_study = Mode_Of_Study::lists('name', 'id');
        $ukba_status = UKBA_Status::lists('name', 'id');

        return view('entities.students.create', compact('modes_of_study', 'awards', 'enrolment_statuses', 'funding_types', 'ukba_status', 'courses'));
    }

    /**
     * Store a newly created student in storage.
     *
     * @return Response
     */
    public function store(CreateStudentRequest $request)
    {
        $newUser = User::create($request->all());

        $newStudent = $newUser->student()->create($request->all());

        $newStudent->calculateEnd()->save();

        $fileUploadMessage = [];

        if (Input::file('userImage')) {
            $file = Input::file('userImage');
            $fileName = $newUser->id.'.'.$file->getClientOriginalExtension(); // renameing image
            $file->move(public_path().'/userImages', $fileName); // uploading file to given path
            $newUser->image = $fileName;
            $newUser->save();
        }
        else {
            // sending back with error message.
            $fileUploadMessage = ['danger_message', 'Failed to upload user profile image'];
        }

        return redirect()->action('StudentsController@show', ['enrolment' => $newStudent->enrolment])->with('success_message', 'Successfully added new student: '.$request->first_name.' '.$request->last_name)->with($fileUploadMessage);
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

        $current_supervisors = Supervisor::with('staff.user')->whereNull('end')->where('student_id', $student->id)->orderBy('start', 'desc')->get();

        $previous_supervisors = Supervisor::with('staff.user')->whereNotNull('end')->where('student_id', $student->id)->orderBy('end', 'desc')->get();

        $all_supervisors = Supervisor::with('staff.user')->where('student_id', $student->id)->orderBy('end', 'desc')->get();

        $history = History::with('student', 'staff')->where('student_id', $student->id)->orderBy('created', 'desc')->get();

        $draft_events = Event::with('student', 'directorOfStudy.user', 'secondSupervisor.user', 'thirdSupervisor.user', 'gs_form')->where('student_id', $student->id)->whereNull('submitted_at')->whereNull('approved_at')->get();

        $submitted_events = Event::with('student', 'directorOfStudy.user', 'secondSupervisor.user', 'thirdSupervisor.user', 'gs_form')->where('student_id', $student->id)->whereNotNull('submitted_at')->whereNull('approved_at')->get();

        $approved_events = Event::with('student', 'directorOfStudy.user', 'secondSupervisor.user', 'thirdSupervisor.user', 'gs_form')->where('student_id', $student->id)->whereNotNull('submitted_at')->whereNotNull('approved_at')->get();

        $upcoming_events = Event::with('student', 'directorOfStudy.user', 'secondSupervisor.user', 'thirdSupervisor.user', 'gs_form')->where('student_id', $student->id)->whereNull('submitted_at')->whereNull('approved_at')->whereRaw('exp_start <= DATE_ADD(NOW(), INTERVAL '.Setting::get('upcomingEventsTimeFrame').' MONTH) AND exp_start >= NOW()')->get();

        return view('entities.students.show', compact('student', 'current_supervisors', 'previous_supervisors', 'all_supervisors', 'history', 'draft_events', 'submitted_events', 'approved_events', 'upcoming_events'));
    }

    /**
     * Show the form for editing the specified student.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($enrolment)
    {
        $modes_of_study = Mode_Of_Study::lists('name', 'id');
        $awards = Award::lists('name', 'id');
        $enrolment_statuses = Enrolment_Status::lists('name', 'id');
        $funding_types = Funding_Type::lists('name', 'id');
        $ukba_status = UKBA_Status::lists('name', 'id');

        $student = Student::with('user')->where('enrolment', $enrolment)->firstOrFail();

        return view('entities.students.edit', compact('student', 'modes_of_study', 'awards', 'enrolment_statuses', 'funding_types', 'ukba_status'));
    }

    /**
     * Update the specified student in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $student_id)
    {
        if ($request['locked'] != '1') {
            $request['locked'] = '0';   
        }
        if ($request['removeUserImage'] != '1') {
            $request['removeUserImage'] = '0';   
        }
        if ($request->end == '0000-00-00' || $request->end == '') {
            $request->end = NULL;
        }
        $user_id = Student::with('user')->where('id', $student_id)->firstOrFail()->user_id;
        // student user rules
        $studentRules = array(
            'award_id' => 'required',
            'email' => 'required|email|unique:users,email,'.$user_id,
            'enrolment' => 'required|unique:students,enrolment,'.$student_id,
            'enrolment_status_id' => 'required',
            'first_name' => 'required|string',
            'funding_type_id' => 'required',
            'home_address' => 'required',
            'last_name' => 'required|string',
            'locked' => 'boolean',
            'middle_name' => 'string',
            'mode_of_study_id' => 'required',
            'nationality' => 'required|string',
            'personal_email' => 'email',
            'personal_phone' => 'string',
            'start' => 'required|date',
            'title' => 'string',
            'ukba_status_id' => 'required',
            'userImage' => 'image|max:1000',
            'removeUserImage' => 'boolean',
            );

        $this->validate($request, $studentRules);

        $student = Student::with('user')->where('id', $student_id)->firstOrFail();

        DB::transaction(function() use ($request, $student)
        {
            try {
                $student->update($request->all());

                if ($request->end == NULL) {
                    $student->update(['end' => NULL]);
                }

                $user = $student->user()->update($request->all());
            } catch (\Exception $e) {
                DB::rollback();
                    // something went wrong
                return redirect()->action('StudentsController@show', ['enrolment' => $student->enrolment])->with('danger_message', 'Failed to update this student');
            }
        });

        $fileUploadMessage = [];

        if (Input::file('userImage')) {
            //remove old image first
            File::delete(public_path().'/userImages/'.$student->user->image);
            $file = Input::file('userImage');
            // renaming image to the users unique id
            $fileName = $student->user->id.'.'.$file->getClientOriginalExtension();
            $file->move(public_path().'/userImages', $fileName); // uploading file to given path
            $student->user->image = $fileName;
            $student->user->save();
        }
        elseif ($request['removeUserImage'] == '1') {
            //remove old image first
            File::delete(public_path().'/userImages/'.$student->user->image);
            $student->user->image = NULL;
            $student->user->save();
        }
        else {
            // sending back with error message.
            $fileUploadMessage = ['danger_message', 'Failed to upload user profile image'];
        }

        return redirect()->action('StudentsController@show', ['enrolment' => $student->enrolment])->with('success_message', 'Successfully updated this student')->with($fileUploadMessage);
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

        $removedStudentName = $student->user->full_name;

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

        File::delete(public_path().'/userImages/'.$student->user->image);

        return redirect()->action('StudentsController@index')->with('info_message', 'Successfully removed student '.$removedStudentName);
    }

    /**
     * Recalculate end date for student
     *
     * @param  string  $enrolment
     * @return redirect to student index
     */
    public function recalculateEndDate($enrolment)
    {
        $student = Student::with('user')->where('enrolment', $enrolment)->firstOrFail();

        if ($student->mode_of_study_id == 1 || $student->mode_of_study_id == 2) {
            $student->calculateEnd()->save();

            return redirect()->action('StudentsController@show', ['enrolment' => $student->enrolment])->with('success_message', 'Successfully updated end date to '.Carbon::parse($student->end)->toDateString());
        }
        else {
            return redirect()->action('StudentsController@show', ['enrolment' => $student->enrolment])->with('warning_message', 'End date not calculated as student is not full or part time');
        }
    }
}