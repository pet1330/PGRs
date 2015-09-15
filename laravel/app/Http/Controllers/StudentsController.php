<?php

namespace App\Http\Controllers;

use App\Absence;
use App\Absence_Type;
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
use App\Role;
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
use Carbon\CarbonInterval;

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

        $current_year_stats = DB::select('SELECT floor(datediff(curdate(),students.start)/365)+1 as year, COUNT(*) as count FROM users, students WHERE users.id = students.user_id AND students.start <= DATE(NOW()) AND students.end > DATE(NOW()) GROUP BY year ORDER BY year');

        $enrolment_status_stats = DB::select('SELECT enrolment_status.name as name, COUNT(*) as count FROM students, enrolment_status WHERE students.enrolment_status_id = enrolment_status.id GROUP BY name ORDER BY name');

        $award_stats = DB::select('SELECT awards.name as name, COUNT(*) as count FROM students, awards WHERE students.award_id = awards.id GROUP BY name ORDER BY name');

        $mode_of_study_stats = DB::select('SELECT modes_of_study.name as name, COUNT(*) as count FROM students, modes_of_study WHERE students.mode_of_study_id = modes_of_study.id GROUP BY name ORDER BY name');

        $ukba_status_stats = DB::select('SELECT ukba_status.name as name, COUNT(*) as count FROM students, ukba_status WHERE students.ukba_status_id = ukba_status.id GROUP BY name ORDER BY name');

        $funding_type_stats = DB::select('SELECT funding_types.name as name, COUNT(*) as count FROM students, funding_types WHERE students.funding_type_id = funding_types.id GROUP BY name ORDER BY name');

        return view('entities.students.index', compact('students', 'current_year_stats', 'enrolment_status_stats', 'award_stats', 'mode_of_study_stats', 'ukba_status_stats', 'funding_type_stats'));
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

        $newUser->attachRole(Role::where('name', 'student')->first());

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

        $expected_events = Event::with('student', 'directorOfStudy.user', 'secondSupervisor.user', 'thirdSupervisor.user', 'gs_form')->where('student_id', $student->id)->whereNull('submitted_at')->whereNull('approved_at')->get();

        $submitted_events = Event::with('student', 'directorOfStudy.user', 'secondSupervisor.user', 'thirdSupervisor.user', 'gs_form')->where('student_id', $student->id)->whereNotNull('submitted_at')->whereNull('approved_at')->get();

        $approved_events = Event::with('student', 'directorOfStudy.user', 'secondSupervisor.user', 'thirdSupervisor.user', 'gs_form')->where('student_id', $student->id)->whereNotNull('submitted_at')->whereNotNull('approved_at')->get();

        $upcoming_events = Event::with('student', 'directorOfStudy.user', 'secondSupervisor.user', 'thirdSupervisor.user', 'gs_form')->where('student_id', $student->id)->whereNull('submitted_at')->whereNull('approved_at')->whereRaw('start <= DATE_ADD(NOW(), INTERVAL '.Setting::get('upcomingEventsTimeFrame').' MONTH) AND start >= NOW()')->get();

        $all_absences = Absence::with('absence_type')->where('student_id', $student->id)->get();

        return view('entities.students.show', compact('student', 'current_supervisors', 'previous_supervisors', 'all_supervisors', 'history', 'expected_events', 'submitted_events', 'approved_events', 'upcoming_events', 'all_absences'));
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
        $student = Student::with('user')->where('id', $student_id)->firstOrFail();

        $previous_award_id = $student->award_id;
        $previous_enrolment_status_id = $student->enrolment_status_id;

        // student user rules
        $studentRules = array(
            'award_id' => 'required',
            'email' => 'required|email|unique:users,email,'.$student->user->id,
            'enrolment' => 'required|regex:/[A-Z]{3}[0-9]{8}/|unique:students,enrolment,'.$student->id,
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

        // System history entries
        if (Setting::get('enableAutomaticHistoryEntires') == 'true') {
            // Auto history entry if the award has been changed
            if ($previous_award_id != $student->award_id) {
                $newAutoHistory = new \App\Libraries\systemHistory;
                $newAutoHistory->create($student->id, 'Award changed', 'The award was changed from '.Award::where('id', $previous_award_id)->first()->name.' to '.Award::where('id', $student->award_id)->first()->name.'.');
            }
            // Auto history entry if the enrolment status has been changed
            if ($previous_enrolment_status_id != $student->enrolment_status_id) {
                $newAutoHistory = new \App\Libraries\systemHistory;
                $newAutoHistory->create($student->id, 'Enrolment status changed', 'The enrolment status has changed from '.Enrolment_Status::where('id', $previous_enrolment_status_id)->first()->name.' to '.Enrolment_Status::where('id', $student->enrolment_status_id)->first()->name.'.');
            }
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

    /**
     * Automatically add GS3 for student
     *
     * @param  string  $enrolment
     * @return redirect to student index
     */
    public function autoGenerateGS3($enrolment)
    {
        $student = Student::with('user')->where('enrolment', $enrolment)->firstOrFail();

        $response = $student->autoGenerateSingleEvent('GS3');
        if ($response == 'DONE') {
            return redirect()->action('StudentsController@show', ['enrolment' => $student->enrolment])->with('success_message', 'Successfully added automatic GS3 event');
        }
        else {
            return redirect()->action('StudentsController@show', ['enrolment' => $student->enrolment])->with('danger_message', 'Failed to add automatic GS3 event');
        }
    }

    /**
     * Automatically add GS5s for student
     *
     * @param  string  $enrolment
     * @return redirect to student index
     */
    public function autoGenerateGS5s($enrolment)
    {
        $student = Student::with('user')->where('enrolment', $enrolment)->firstOrFail();

        $response = $student->autoGenerateGS5s();

        if (is_numeric($response)) {
            return redirect()->action('StudentsController@show', ['enrolment' => $student->enrolment])->with('success_message', 'Successfully added '.$response.' automatic GS5 events');
        }
        elseif ($response == 'noEND') {
            return redirect()->action('StudentsController@show', ['enrolment' => $student->enrolment])->with('warning_message', 'Cannot automatically add GS5 events as no end date has been set');
        }
        elseif ($response == 'notFTorPT') {
            return redirect()->action('StudentsController@show', ['enrolment' => $student->enrolment])->with('warning_message', 'GS5 events not added as student is not full or part time');
        }
        else {
            return redirect()->action('StudentsController@show', ['enrolment' => $student->enrolment]);
        }
    }

    /**
     * Automatically add GS5b for student
     *
     * @param  string  $enrolment
     * @return redirect to student index
     */
    public function autoGenerateGS5b($enrolment)
    {
        $student = Student::with('user')->where('enrolment', $enrolment)->firstOrFail();

        $response = $student->autoGenerateSingleEvent('GS5b');
        if ($response == 'DONE') {
            return redirect()->action('StudentsController@show', ['enrolment' => $student->enrolment])->with('success_message', 'Successfully added automatic GS5b event');
        }
        else {
            return redirect()->action('StudentsController@show', ['enrolment' => $student->enrolment])->with('danger_message', 'Failed to add automatic GS5b event');
        }
    }

    /**
     * Automatically add GS7 for student
     *
     * @param  string  $enrolment
     * @return redirect to student index
     */
    public function autoGenerateGS7($enrolment)
    {
        $student = Student::with('user')->where('enrolment', $enrolment)->firstOrFail();

        $response = $student->autoGenerateSingleEvent('GS7');
        if ($response == 'DONE') {
            return redirect()->action('StudentsController@show', ['enrolment' => $student->enrolment])->with('success_message', 'Successfully added automatic GS7 event');
        }
        else {
            return redirect()->action('StudentsController@show', ['enrolment' => $student->enrolment])->with('danger_message', 'Failed to add automatic GS7 event');
        }
    }

    /**
     * Automatically add GS8 for student
     *
     * @param  string  $enrolment
     * @return redirect to student index
     */
    public function autoGenerateGS8($enrolment)
    {
        $student = Student::with('user')->where('enrolment', $enrolment)->firstOrFail();

        $response = $student->autoGenerateSingleEvent('GS8');
        if ($response == 'DONE') {
            return redirect()->action('StudentsController@show', ['enrolment' => $student->enrolment])->with('success_message', 'Successfully added automatic GS8 event');
        }
        else {
            return redirect()->action('StudentsController@show', ['enrolment' => $student->enrolment])->with('danger_message', 'Failed to add automatic GS8 event');
        }
    }

    /**
     * Import new student for processing.
     *
     * @return Response
*/
    public function importNew(Request $request)
    {
        $this->validate($request, [
            'csvFile' => 'required|mimes:csv,txt|max:1000',
            ]);
        set_time_limit(300);
        $imported = 0;
        if(($handle = fopen(Input::file('csvFile'), "r")) !== FALSE) {
            $isError = false;
            $errors = [];
            $row = 1;
            while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
                $userData = new Request;
                $userData['title'] = $data[1];
                $userData['first_name'] = $data[2];
                $userData['middle_name'] = $data[3];
                $userData['last_name'] = $data[4];
                $userData['email'] = $data[5];
                $userData['personal_email'] = $data[6];
                $userData['personal_phone'] = $data[7];
                if ($data[8]) {
                    $userData['password'] = bcrypt($data[8]);
                }
                else {
                    $userData['password'] = bcrypt(substr( "abcdefghijklmnopqrstuvwxyz" ,mt_rand( 0 ,25 ) ,1 ) .substr( md5( time( ) ) ,1 ));
                }
                if ($data[9] == 'YES') {
                    $userData['locked'] = '1';
                }
                else {
                    $userData['locked'] = '0';
                }

                $userValidator = Validator::make($userData->all(), [
                    'title' => 'string',
                    'first_name' => 'required|string',
                    'middle_name' => 'string',
                    'last_name' => 'required|string',
                    'email' => 'required|email|unique:users,email',
                    'personal_email' => 'email',
                    'personal_phone' => 'string',
                    'password' => 'required',
                    'locked' => 'boolean',
                    ]);
                    // Something's not right with this user data
                if ($userValidator->fails()) {
                    $isError = true;
                    foreach ($userValidator->messages()->all() as $message) {
                        array_push($errors, 'Row '.$row.': '.$message);
                    }
                }
                else
                {
                    $studentData = new Request;
                    $studentData['enrolment'] = $data[0];
                    if ($data[10]) {
                        $studentData['dob'] = Carbon::parse(str_replace('/', '-', $data[10]))->toDateString();
                    }
                    $studentData['gender'] = $data[11];
                    $studentData['home_address'] = $data[12];
                    $studentData['current_address'] = $data[13];
                    $studentData['nationality'] = $data[14];
                    if ($data[15]) {
                        $studentData['start'] = Carbon::parse(str_replace('/', '-', $data[15]))->toDateString();
                    }
                    if ($data[16]) {
                        $studentData['end'] = Carbon::parse(str_replace('/', '-', $data[16]))->toDateString();
                    }
                    $studentData['award'] = $data[17];
                    $studentData['modes_of_study'] = $data[18];
                    $studentData['course'] = $data[19];
                    $studentData['enrolment_status'] = $data[20];
                    $studentData['funding_type'] = $data[21];
                    $studentData['ukba_status'] = $data[22];

                    $studentValidator = Validator::make($studentData->all(), [
                        'enrolment' => 'required|regex:/[A-Z]{3}[0-9]{8}/|unique:students,enrolment',
                        'dob' => 'date',
                        'gender' =>'in:Male,Female,Other',
                        'home_address' => 'string|required',
                        'current_address' => 'string',
                        'nationality' => 'string|required',
                        'start' => 'date|required',
                        'end' => 'date',
                        'award' => 'required|exists:awards,name',
                        'modes_of_study' => 'required|exists:modes_of_study,name',
                        'course' => 'required|exists:courses,name',
                        'enrolment_status' => 'required|exists:enrolment_status,name',
                        'funding_type' => 'required|exists:funding_types,name',
                        'ukba_status' => 'required|exists:ukba_status,name',
                        ]);

                        // Something's not right with the student data
                    if ($studentValidator->fails()) {
                        $isError = true;
                        foreach ($studentValidator->messages()->all() as $message) {
                            array_push($errors, 'Row '.$row.': '.$message);
                        }
                    }
                    else {
                        $supervisorData = new Request;
                        $supervisorData['1_email'] = $data[23];
                        $supervisorData['2_email'] = $data[24];
                        $supervisorData['3_email'] = $data[25];

                        $supervisorValidator = Validator::make($supervisorData->all(), [
                            '1_email' => 'exists:users,email',
                            '2_email' => 'exists:users,email',
                            '3_email' => 'exists:users,email',
                            ]);

                        // Something's not right with the supervisor emails
                        if ($supervisorValidator->fails()) {
                            $isError = true;
                            foreach ($supervisorValidator->messages()->all() as $message) {
                                array_push($errors, 'Row '.$row.': '.$message);
                            }
                        }
                        else {
                            try {
                                DB::transaction(function () use($userData, $studentData, $supervisorData, $request) {
                                    $newUser = User::create($userData->all());
                                    $studentData['user_id'] = $newUser->id;
                                    $studentData['award_id'] = Award::where('name', $studentData['award'])->first()->id;
                                    $studentData['mode_of_study_id'] = Mode_Of_Study::where('name', $studentData['modes_of_study'])->first()->id;
                                    $studentData['course_id'] = Course::where('name', $studentData['course'])->first()->id;
                                    $studentData['enrolment_status_id'] = Enrolment_Status::where('name', $studentData['enrolment_status'])->firstOrFail()->id;
                                    $studentData['funding_type_id'] = Funding_Type::where('name', $studentData['funding_type'])->first()->id;
                                    $studentData['ukba_status_id'] = UKBA_Status::where('name', $studentData['ukba_status'])->first()->id;
                                    $newStudent = $newUser->student()->create($studentData->all());
                                    $newUser->attachRole(Role::where('name', 'student')->first());
                                    $newStudent->calculateEnd()->save();

                                    // add supervisors if provided
                                    if ($supervisorData['1_email']) {
                                        $this_supervisor = User::with('staff')->where('email', $supervisorData['1_email'])->first();
                                        $newSupervisor = Supervisor::create([
                                            'student_id' => $newStudent->id,
                                            'staff_id' => $this_supervisor->staff->id,
                                            'order' => 1,
                                            'start' => $newStudent->start,
                                            'end' => NULL]);
                                    }
                                    if ($supervisorData['2_email']) {
                                        $this_supervisor = User::with('staff')->where('email', $supervisorData['2_email'])->first();
                                        $newSupervisor = Supervisor::create([
                                            'student_id' => $newStudent->id,
                                            'staff_id' => $this_supervisor->staff->id,
                                            'order' => 2,
                                            'start' => $newStudent->start,
                                            'end' => NULL]);
                                    }
                                    if ($supervisorData['3_email']) {
                                        $this_supervisor = User::with('staff')->where('email', $supervisorData['3_email'])->first();
                                        $newSupervisor = Supervisor::create([
                                            'student_id' => $newStudent->id,
                                            'staff_id' => $this_supervisor->staff->id,
                                            'order' => 3,
                                            'start' => $newStudent->start,
                                            'end' => NULL]);
                                    }

                                    // add auto events
                                    if ($request->autoGenerateEnabled == 1) {
                                        $newStudent->autoGenerateAllEvents();
                                    }
                                });
$imported++;
} catch (Exception $e) {
    $isError = true;
    array_push($errors, 'Row '.$row.' '.$e);
}
}
}
}
$row++;
}
fclose($handle);
if ($isError) {
    return redirect('import')->withErrors($errors)->with('danger_message', 'There where some errors!')->with('success_message', 'Imported '.$imported.' students successfully');
}
}
return redirect('import')->with('success_message', 'Imported '.$imported.' students successfully');
}
}