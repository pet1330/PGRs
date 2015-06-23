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
        factory('App\User', 'Student', 200)->create()->each(function($u) {
    		$u->student()->save(factory('App\Student')->make());
    	});
    }
}
