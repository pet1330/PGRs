<?php

use Illuminate\Database\Seeder;

class StaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\User', 'Staff', 20)->create()->each(function($u) {
    		$u->student()->save(factory('App\Staff')->make());
    	});

        DB::table('users')->where('id', 1)->update([
            'title' => NULL,
            'first_name' => 'TEST',
            'middle_name' => 'ADMIN',
            'last_name' => 'ACCOUNT',
            'personal_email' => NULL,
            'personal_phone' => NULL,
            'email' => 'test@test.com']);
    }
}