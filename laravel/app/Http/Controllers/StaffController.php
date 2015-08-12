<?php

namespace App\Http\Controllers;

use App\User;
use App\Staff;
use App\Supervisor;
use App\Role;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\HttpResponse;

use DB;
use File;
use Input;

use Entrust;

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
        $all_roles = Role::lists('display_name', 'id');
        return view('entities.staff.create', compact('all_roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'locked' => 'boolean',
            'middle_name' => 'string',
            'personal_email' => 'email',
            'personal_phone' => 'string',
            'title' => 'string',
            'userImage' => 'image|max:1000',
            'position' => 'string',
            'room' => 'string',
            'about' => 'string'
            ]);

        $newUser = User::create($request->all());

        $newStaff = $newUser->staff()->create($request->all());

        if(! empty($request['roles'])) {
            $newUser->roles()->sync($request['roles']);
        } else {
            $newUser->roles()->detach();
        }

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
        $staff = Staff::with('user.roles')->where('id', $id)->firstOrFail();

        $all_roles = Role::lists('display_name', 'id');

        return view('entities.staff.edit', compact('staff', 'all_roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        if (Entrust::hasRole('admin') && $request['locked'] != '1') {
            $request['locked'] = '0';
        }
        if ($request['removeUserImage'] != '1') {
            $request['removeUserImage'] = '0';   
        }
        $staff = Staff::with('user')->where('id', $id)->firstOrFail();

        // staff user rules
        $staffRules = array(
            'email' => 'required|email|unique:users,email,'.$staff->user_id,
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'locked' => 'boolean',
            'middle_name' => 'string',
            'personal_email' => 'email',
            'personal_phone' => 'string',
            'title' => 'string',
            'userImage' => 'image|max:1000',
            'removeUserImage' => 'boolean',
            'position' => 'string',
            'room' => 'string',
            'about' => 'string'
            );

        $this->validate($request, $staffRules);

        DB::transaction(function() use ($request, $staff)
        {
            try {
                $staff->update($request->all());

                $user = $staff->user()->update($request->all());
            } catch (\Exception $e) {
                DB::rollback();
                    // something went wrong
                return redirect()->action('StaffController@show', ['id' => $staff->id])->with('danger_message', 'Failed to update staff member '.$staff->user->full_name);
            }
        });

        $fileUploadMessage = [];

        if (Input::file('userImage')) {
            //remove old image first
            File::delete(public_path().'/userImages/'.$staff->user->image);
            $file = Input::file('userImage');
            // renaming image to the users unique id
            $fileName = $staff->user->id.'.'.$file->getClientOriginalExtension();
            $file->move(public_path().'/userImages', $fileName); // uploading file to given path
            $staff->user->image = $fileName;
            $staff->user->save();
        }
        elseif ($request['removeUserImage'] == '1') {
            //remove old image first
            File::delete(public_path().'/userImages/'.$staff->user->image);
            $staff->user->image = NULL;
            $staff->user->save();
        }
        else {
            // sending back with error message.
            $fileUploadMessage = ['danger_message', 'Failed to upload user profile image'];
        }


        if(Entrust::hasRole('admin') && !empty($request['roles'])) {
            $staff->user->roles()->sync($request['roles']);
        } elseif (Entrust::hasRole('admin')) {
            $staff->user->roles()->detach();
        }

        return redirect()->action('StaffController@show', ['id' => $staff->id])->with('success_message', 'Successfully updated this staff member')->with($fileUploadMessage);
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
