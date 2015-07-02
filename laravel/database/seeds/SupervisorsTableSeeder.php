<?php

use Illuminate\Database\Seeder;

class SupervisorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$supervisors = factory(App\Supervisor::class, 50)->create();
    }
}
