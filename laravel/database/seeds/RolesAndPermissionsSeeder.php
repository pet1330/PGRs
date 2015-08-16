<?php

use Illuminate\Database\Seeder;
use \App\Role;
use \App\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('roles')->delete();
    	DB::table('permissions')->delete();


    	// ROLES
    	$admin = new Role();
    	$admin->name = 'admin';
        $admin->display_name = 'System administrator';
        $admin->save();

        $staff = new Role();
        $staff->name = 'staff';
        $staff->display_name = 'Staff member';
        $staff->save();

        $student = new Role();
        $student->name = 'student';
        $student->display_name = 'Student';
        $student->save();


    	// PERMISSIONS

        // User administration permissions
        $reset_password = new Permission();
        $reset_password->name = 'can_reset_user_password';
        $reset_password->display_name = 'Can Reset User Password';
        $reset_password->save();

    	// Student administration permissions
        $create_student = new Permission();
        $create_student->name = 'can_create_student';
        $create_student->display_name = 'Can Create Students';
        $create_student->save();

        $edit_student = new Permission();
        $edit_student->name = 'can_edit_student';
        $edit_student->display_name = 'Can Edit Students';
        $edit_student->save();

        $destroy_student = new Permission();
        $destroy_student->name = 'can_destroy_student';
        $destroy_student->display_name = 'Can Destroy Students';
        $destroy_student->save();

        $recalculte_student_end_date = new Permission();
        $recalculte_student_end_date->name = 'can_recalculate_student_end_date';
        $recalculte_student_end_date->display_name = 'Can Reset User Password';
        $recalculte_student_end_date->save();

        $admin->attachPermission($create_student);
        $admin->attachPermission($edit_student);
        $admin->attachPermission($destroy_student);
        $admin->attachPermission($reset_password);
        $admin->attachPermission($recalculte_student_end_date);

        // Staff administration permissions
        $create_staff = new Permission();
        $create_staff->name = 'can_create_staff';
        $create_staff->display_name = 'Can Create Staff';
        $create_staff->save();

        $edit_staff = new Permission();
        $edit_staff->name = 'can_edit_staff';
        $edit_staff->display_name = 'Can Edit Staff';
        $edit_staff->save();

        $destroy_staff = new Permission();
        $destroy_staff->name = 'can_destroy_staff';
        $destroy_staff->display_name = 'Can Destroy Staff';
        $destroy_staff->save();

        $admin->attachPermission($create_staff);
        $admin->attachPermission($edit_staff);
        $admin->attachPermission($destroy_staff);

    	// Supervision record administration permissions
        $create_supervision_record = new Permission();
        $create_supervision_record->name = 'can_create_supervision_record';
        $create_supervision_record->display_name = 'Can Create Supervision Record';
        $create_supervision_record->save();

        $edit_supervision_record = new Permission();
        $edit_supervision_record->name = 'can_edit_supervision_record';
        $edit_supervision_record->display_name = 'Can Edit Supervision Record';
        $edit_supervision_record->save();

        $destory_supervision_record = new Permission();
        $destory_supervision_record->name = 'can_destroy_supervision_record';
        $destory_supervision_record->display_name = 'Can Destroy Supervision Record';
        $destory_supervision_record->save();

        $admin->attachPermission($create_supervision_record);
        $admin->attachPermission($edit_supervision_record);
        $admin->attachPermission($destory_supervision_record);

    	// GS Form administration permissions
        $create_gs_form_event = new Permission();
        $create_gs_form_event->name = 'can_create_gs_form_event';
        $create_gs_form_event->display_name = 'Can Create GS Form Event';
        $create_gs_form_event->save();

        $edit_gs_form_event = new Permission();
        $edit_gs_form_event->name = 'can_edit_gs_form_event';
        $edit_gs_form_event->display_name = 'Can Edit GS Form Event';
        $edit_gs_form_event->save();

        $destroy_gs_form_event = new Permission();
        $destroy_gs_form_event->name = 'can_destroy_gs_form_event';
        $destroy_gs_form_event->display_name = 'Can Destroy GS Form Event';
        $destroy_gs_form_event->save();

        $auto_generate_gs_forms = new Permission();
        $auto_generate_gs_forms->name = 'can_auto_generate_gs_form_events';
        $auto_generate_gs_forms->display_name = 'Can Automatically Generate GS Form Events';
        $auto_generate_gs_forms->save();

        $admin->attachPermission($auto_generate_gs_forms);
        $admin->attachPermission($create_gs_form_event);
        $admin->attachPermission($edit_gs_form_event);
        $admin->attachPermission($destroy_gs_form_event);

    	// Student history permissions
        $view_any_student_history = new Permission();
        $view_any_student_history->name = 'can_view_any_student_history';
        $view_any_student_history->display_name = 'Can View Any Student History';
        $view_any_student_history->save();

        $view_my_students_history = new Permission();
        $view_my_students_history->name = 'can_view_my_students_history';
        $view_my_students_history->display_name = 'Can View My Students History';
        $view_my_students_history->save();

        $create_any_student_history = new Permission();
        $create_any_student_history->name = 'can_create_any_student_history';
        $create_any_student_history->display_name = 'Can Create Any Student History';
        $create_any_student_history->save();

        $create_my_students_history = new Permission();
        $create_my_students_history->name = 'can_create_my_students_history';
        $create_my_students_history->display_name = 'Can Create My Students History';
        $create_my_students_history->save();

        $edit_any_student_history = new Permission();
        $edit_any_student_history->name = 'can_edit_any_student_history';
        $edit_any_student_history->display_name = 'Can Edit Any Student History';
        $edit_any_student_history->save();

        $edit_my_students_history = new Permission();
        $edit_my_students_history->name = 'can_edit_my_students_history';
        $edit_my_students_history->display_name = 'Can Edit My Students History';
        $edit_my_students_history->save();

        $destroy_my_student_history = new Permission();
        $destroy_my_student_history->name = 'can_destroy_my_student_history';
        $destroy_my_student_history->display_name = 'Can Destroy My Student History';
        $destroy_my_student_history->save();

        $destroy_any_student_history = new Permission();
        $destroy_any_student_history->name = 'can_destroy_any_student_history';
        $destroy_any_student_history->display_name = 'Can Destroy Any Student History';
        $destroy_any_student_history->save();

        $admin->attachPermission($view_any_student_history);
        $admin->attachPermission($create_any_student_history);
        $admin->attachPermission($edit_any_student_history);
        $admin->attachPermission($destroy_any_student_history);

        $staff->attachPermission($view_my_students_history);
        $staff->attachPermission($create_my_students_history);
        $staff->attachPermission($edit_my_students_history);
        $staff->attachPermission($destroy_my_student_history);

         // Student absence permissions
        $create_any_student_absence = new Permission();
        $create_any_student_absence->name = 'can_create_any_student_absence';
        $create_any_student_absence->display_name = 'Can Create Any Student Absence';
        $create_any_student_absence->save();

        $create_my_student_absence = new Permission();
        $create_my_student_absence->name = 'can_create_my_student_absence';
        $create_my_student_absence->display_name = 'Can Create My Student Absence';
        $create_my_student_absence->save();

        $edit_any_student_absence = new Permission();
        $edit_any_student_absence->name = 'can_edit_any_student_absence';
        $edit_any_student_absence->display_name = 'Can Edit Any Student Absence';
        $edit_any_student_absence->save();

        $edit_my_student_absence = new Permission();
        $edit_my_student_absence->name = 'can_edit_my_student_absence';
        $edit_my_student_absence->display_name = 'Can Edit My Student Absence';
        $edit_my_student_absence->save();

        $destroy_any_student_absence = new Permission();
        $destroy_any_student_absence->name = 'can_destroy_any_student_absence';
        $destroy_any_student_absence->display_name = 'Can Destroy Any Student Absence';
        $destroy_any_student_absence->save();

        $destroy_my_student_absence = new Permission();
        $destroy_my_student_absence->name = 'can_destroy_my_student_absence';
        $destroy_my_student_absence->display_name = 'Can Destroy My Student Absence';
        $destroy_my_student_absence->save();

        $admin->attachPermission($create_any_student_absence);
        $admin->attachPermission($edit_any_student_absence);
        $admin->attachPermission($destroy_any_student_absence);

        $staff->attachPermission($create_my_student_absence);
        $staff->attachPermission($edit_my_student_absence);
        $admin->attachPermission($destroy_my_student_absence);

        $edit_own_profile = new Permission();
        $edit_own_profile->name = 'can_edit_own_profile';
        $edit_own_profile->display_name = 'Can Edit Own User Profile';
        $edit_own_profile->save();

        $staff->attachPermission($edit_own_profile);
        $admin->attachPermission($edit_own_profile);

        /* ... */
        $testAdmin = App\User::where('email', 'test@test.com')->first();
        $testAdmin->attachRole($admin);

        //add staff role to all staff users
        for ($x = 1; $x <= 20; $x++) {
            $staffUser = App\User::find($x);
            $staffUser->attachRole($staff);
        }

        //add student role to all student users
        for ($x = 21; $x <= 120; $x++) {
            $studentUser = App\User::find($x);
            $studentUser->attachRole($student);
        }
    }
}
