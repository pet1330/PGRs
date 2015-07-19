<?php

namespace App\Http\Controllers;

use App\User;
use App\Staff;
use App\Supervisor;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\HttpResponse;

use DB;

use File;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $staff = Staff::all();

        return view('entities.staff.index', compact('staff'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('entities.staff.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['email' => 'required|email|unique:users',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'university_email' => 'email']);

        $newUser = User::create(['title' => $request->title,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'personal_email' => $request->personal_email,
            'email' => $request->email,
            'personal_phone' => $request->personal_phone,
            'account_type' => 'Staff',
            ]);

        $newStaff = $newUser->staff()->create(['position' => $request->position,
            'university_phone' => $request->university_phone,
            'room' => $request->room,
            'about' => $request->about,
            ]);

        return redirect()->action('StaffController@index')->with('success_message', 'Successfully added new staff member');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $staff = Staff::with('user')->where('id', $id)->firstOrFail();

        $myStudents_1 = Supervisor::with('student.user')->where('staff_id', $id)->where('order', 1)->whereNull('end')->get();
        $myStudents_2 = Supervisor::with('student.user')->where('staff_id', $id)->where('order', 2)->whereNull('end')->get();
        $myStudents_3 = Supervisor::with('student.user')->where('staff_id', $id)->where('order', 3)->whereNull('end')->get();

        return view('entities.staff.show', compact('staff', 'myStudents_1', 'myStudents_2', 'myStudents_3'));
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
        $staff = Staff::with('user')->where('id', $id)->firstOrFail();
        if (count($staff->studentsSupervised) > 0) {
            return redirect()->action('StaffController@show', ['id' => $staff->id])->with('danger_message', 'Cannot removed staff member as they still supervise students!');
        }
        else {

            $removedStaffName = $staff->user->full_name;

            DB::transaction(function() use ($id, $staff, $removedStaffName)
            {
                try {
                    $staff->delete();

                    $staff->user()->delete();
                } catch (\Exception $e) {
                    DB::rollback();
                    dd($e);
                // something went wrong
                    return redirect()->action('StaffController@index')->with('danger_message', 'There was an error removing the staff member '.$removedStaffName);
                }
            });

            File::delete(public_path().'/userImages/'.$staff->user->image);

            return redirect()->action('StaffController@index')->with('info_message', 'Successfully removed staff member '.$removedStaffName);
        }
    }
}
