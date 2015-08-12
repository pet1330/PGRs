<?php

use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for ($i=0; $i < 100; $i++) {
    		\App\Student::find($i+1)->calculateEnd()->save();
    		\App\Student::find($i+1)->autoGenerateAllEvents();
    	}
    }
}
