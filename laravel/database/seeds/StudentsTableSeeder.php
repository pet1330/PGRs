<?php

use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\User', 'Student', 100)->create()->each(function($u) {
            $u->student()->save(factory('App\Student')->make());
        });

        DB::table('users')->where('id', 21)->update([
            'title' => NULL,
            'first_name' => 'TEST',
            'middle_name' => NULL,
            'last_name' => 'STUDENT',
            'personal_email' => NULL,
            'personal_phone' => NULL,
            'email' => 'student@test.com']);

        DB::table('students')->where('id', 1)->update([
            'enrolment' => 'TES12345678']);
    }
}
