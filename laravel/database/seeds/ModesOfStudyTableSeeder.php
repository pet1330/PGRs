<?php

use Illuminate\Database\Seeder;

class ModesOfStudyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modes_of_study')->insert(['name' => 'Full time']);
        DB::table('modes_of_study')->insert(['name' => 'Part time']);
        DB::table('modes_of_study')->insert(['name' => 'Distance learning']);
    }
}
