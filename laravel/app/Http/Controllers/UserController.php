<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Entrust;

use Auth;
use App\Staff;
use App\Supervisor;
use App\Student;
use App\Event;
use App\Absence;
use Setting;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function home()
    {
    	if (Entrust::hasRole('admin')) {
        $current_year_stats = DB::select('SELECT floor(datediff(curdate(),students.start)/365)+1 as year, COUNT(*) as count FROM users, students WHERE users.id = students.user_id AND students.start <= DATE(NOW()) AND students.end > DATE(NOW()) GROUP BY year ORDER BY year');

        $enrolment_status_stats = DB::select('SELECT enrolment_status.name as name, COUNT(*) as count FROM students, enrolment_status WHERE students.enrolment_status_id = enrolment_status.id AND enrolment_status.id != 1 GROUP BY name ORDER BY name');

        $award_stats = DB::select('SELECT awards.name as name, COUNT(*) as count FROM students, awards WHERE students.award_id = awards.id GROUP BY name ORDER BY name');

        $mode_of_study_stats = DB::select('SELECT modes_of_study.name as name, COUNT(*) as count FROM students, modes_of_study WHERE students.mode_of_study_id = modes_of_study.id GROUP BY name ORDER BY name');

        $ukba_status_stats = DB::select('SELECT ukba_status.name as name, COUNT(*) as count FROM students, ukba_status WHERE students.ukba_status_id = ukba_status.id GROUP BY name ORDER BY name');

        $funding_type_stats = DB::select('SELECT funding_types.name as name, COUNT(*) as count FROM students, funding_types WHERE students.funding_type_id = funding_types.id GROUP BY name ORDER BY name');

    		return view('admin.pages.dashboard', compact('current_year_stats', 'enrolment_status_stats', 'award_stats', 'mode_of_study_stats', 'ukba_status_stats', 'funding_type_stats'));
    	}
    	elseif (Entrust::hasRole('staff')) {
        $staff = Staff::with('user')->where('user_id', Auth::user()->id)->firstOrFail();

        $myStudents_1 = Supervisor::with('student.user')->where('staff_id', $staff->id)->where('order', 1)->whereNull('end')->get();
        $myStudents_2 = Supervisor::with('student.user')->where('staff_id', $staff->id)->where('order', 2)->whereNull('end')->get();
        $myStudents_3 = Supervisor::with('student.user')->where('staff_id', $staff->id)->where('order', 3)->whereNull('end')->get();

        $past_myStudents_1 = Supervisor::with('student.user')->where('staff_id', $staff->id)->where('order', 1)->whereNotNull('end')->get();
        $past_myStudents_2 = Supervisor::with('student.user')->where('staff_id', $staff->id)->where('order', 2)->whereNotNull('end')->get();
        $past_myStudents_3 = Supervisor::with('student.user')->where('staff_id', $staff->id)->where('order', 3)->whereNotNull('end')->get();

        $all_upcoming_events = Event::with('student', 'directorOfStudy.user', 'gs_form')->where('director_of_study_id', $staff->id)->whereNull('submitted_at')->whereNull('approved_at')->whereRaw('start <= DATE_ADD(NOW(), INTERVAL '.Setting::get('upcomingEventsTimeFrame').' MONTH) AND start >= NOW()')->get();

        return view('staff.pages.dashboard', compact('myStudents_1', 'myStudents_2', 'myStudents_3', 'past_myStudents_1', 'past_myStudents_2', 'past_myStudents_3', 'all_upcoming_events'));
      }
      elseif (Entrust::hasRole('student')) {
        $student = Student::with('user')->where('user_id', Auth::user()->id)->firstOrFail();

        $current_supervisors = Supervisor::with('staff.user')->whereNull('end')->where('student_id', $student->id)->orderBy('start', 'desc')->get();

        $previous_supervisors = Supervisor::with('staff.user')->whereNotNull('end')->where('student_id', $student->id)->orderBy('end', 'desc')->get();

        $all_supervisors = Supervisor::with('staff.user')->where('student_id', $student->id)->orderBy('end', 'desc')->get();

        $expected_events = Event::with('student', 'directorOfStudy.user', 'secondSupervisor.user', 'thirdSupervisor.user', 'gs_form')->where('student_id', $student->id)->whereNull('submitted_at')->whereNull('approved_at')->get();

        $submitted_events = Event::with('student', 'directorOfStudy.user', 'secondSupervisor.user', 'thirdSupervisor.user', 'gs_form')->where('student_id', $student->id)->whereNotNull('submitted_at')->whereNull('approved_at')->get();

        $approved_events = Event::with('student', 'directorOfStudy.user', 'secondSupervisor.user', 'thirdSupervisor.user', 'gs_form')->where('student_id', $student->id)->whereNotNull('submitted_at')->whereNotNull('approved_at')->get();

        $upcoming_events = Event::with('student', 'directorOfStudy.user', 'secondSupervisor.user', 'thirdSupervisor.user', 'gs_form')->where('student_id', $student->id)->whereNull('submitted_at')->whereNull('approved_at')->whereRaw('start <= DATE_ADD(NOW(), INTERVAL '.Setting::get('upcomingEventsTimeFrame').' MONTH) AND start >= NOW()')->get();

        $all_absences = Absence::with('absence_type')->where('student_id', $student->id)->get();

        return view('student.pages.dashboard', compact('student', 'current_supervisors', 'previous_supervisors', 'all_supervisors', 'expected_events', 'submitted_events', 'approved_events', 'upcoming_events', 'all_absences'));
      }
    }

    public function profile()
    {
      if (Entrust::hasRole('admin')) {
        $staff = Staff::with('user.roles')->where('user_id', Auth::user()->id)->firstOrFail();

        return redirect()->action('StaffController@show', ['id' => $staff->id]);
      }
      elseif (Entrust::hasRole('staff')) {
        $staff = Staff::with('user.roles')->where('user_id', Auth::user()->id)->firstOrFail();

        return redirect()->action('StaffController@show', ['id' => $staff->id]);
      }
      elseif (Entrust::hasRole('student')) {
        return view('global.pages.student_profile');
      }
    }

    public function settings()
    {
      return 'In the works...';
    }
  }
