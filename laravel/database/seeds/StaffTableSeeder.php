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
        factory('App\User', 20)->create()->each(function($u) {
    		$u->student()->save(factory('App\Staff')->make());
    	});
    }
}
