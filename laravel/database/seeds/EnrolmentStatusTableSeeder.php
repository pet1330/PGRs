<?php

use Illuminate\Database\Seeder;

class EnrolmentStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('enrolment_status')->insert(['name' => 'Applied']);
        DB::table('enrolment_status')->insert(['name' => 'Enrolled']);
        DB::table('enrolment_status')->insert(['name' => 'Withdrawn']);
        DB::table('enrolment_status')->insert(['name' => 'Graduated']);
    }
}
