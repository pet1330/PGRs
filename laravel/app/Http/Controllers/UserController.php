<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Entrust;

use Auth;
use App\Staff;
use App\Supervisor;
use App\Event;
use Setting;

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
    		return view('admin.pages.dashboard');
    	}
    	elseif (Entrust::hasRole('staff')) {
            $staff = Staff::with('user')->where('user_id', Auth::user()->id)->firstOrFail();

            $myStudents_1 = Supervisor::with('student.user')->where('staff_id', $staff->id)->where('order', 1)->whereNull('end')->get();
            $myStudents_2 = Supervisor::with('student.user')->where('staff_id', $staff->id)->where('order', 2)->whereNull('end')->get();
            $myStudents_3 = Supervisor::with('student.user')->where('staff_id', $staff->id)->where('order', 3)->whereNull('end')->get();

            $past_myStudents_1 = Supervisor::with('student.user')->where('staff_id', $staff->id)->where('order', 1)->whereNotNull('end')->get();
            $past_myStudents_2 = Supervisor::with('student.user')->where('staff_id', $staff->id)->where('order', 2)->whereNotNull('end')->get();
            $past_myStudents_3 = Supervisor::with('student.user')->where('staff_id', $staff->id)->where('order', 3)->whereNotNull('end')->get();

            $all_upcoming_events = Event::with('student', 'directorOfStudy.user', 'gs_form')->where('director_of_study_id', $staff->id)->whereNull('submitted_at')->whereNull('approved_at')->whereRaw('exp_start <= DATE_ADD(NOW(), INTERVAL '.Setting::get('upcomingEventsTimeFrame').' MONTH) AND exp_start >= NOW()')->get();

            return view('staff.pages.dashboard', compact('myStudents_1', 'myStudents_2', 'myStudents_3', 'past_myStudents_1', 'past_myStudents_2', 'past_myStudents_3', 'all_upcoming_events'));
        }
        elseif (Entrust::hasRole('student')) {
          return view('student.pages.dashboard');
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
