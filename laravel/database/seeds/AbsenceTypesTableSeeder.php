<?php

use Illuminate\Database\Seeder;

class AbsenceTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('absence_types')->insert([
            'name' => 'Sick',
            'description' => 'The student is ill',
        ]);
        DB::table('absence_types')->insert([
            'name' => 'Holiday',
            'description' => 'The student is on holiday',
        ]);
    }
}
