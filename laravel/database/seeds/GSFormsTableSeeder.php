<?php

use Illuminate\Database\Seeder;

class GSFormsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gs_forms')->insert([
            'name' => 'GS1',
            'description' => 'Postgraduate application',
        ]);
        DB::table('gs_forms')->insert([
            'name' => 'GS2',
            'description' => 'Interview Decision',
        ]);
        DB::table('gs_forms')->insert([
            'name' => 'GS3',
            'description' => 'Confirmation of Programme of Study',
        ]);
        DB::table('gs_forms')->insert([
            'name' => 'GS4',
            'description' => 'Record of Consultation Between Research Student and Supervisor',
        ]);
        DB::table('gs_forms')->insert([
            'name' => 'GS5',
            'description' => 'Progress Record',
        ]);
        DB::table('gs_forms')->insert([
            'name' => 'GS5B',
            'description' => 'Application for Research Award Transfer',
        ]);
    }
}
