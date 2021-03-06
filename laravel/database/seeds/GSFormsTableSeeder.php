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
            'description' => 'Postgraduate Application',
            ]);
        DB::table('gs_forms')->insert([
            'name' => 'GS2',
            'description' => 'Interview Decision',
            'approved_enabled' => 1,
            ]);
        DB::table('gs_forms')->insert([
            'name' => 'GS3',
            'description' => 'Confirmation of Programme of Study',
            'defaultStartMonth' => 3,
            'approved_enabled' => 1,
            ]);
        DB::table('gs_forms')->insert([
            'name' => 'GS4',
            'description' => 'Record of Consultation Between Research Student and Supervisor',
            ]);
        DB::table('gs_forms')->insert([
            'name' => 'GS5',
            'description' => 'Research Student Progress Record',
            'defaultStartMonth' => 12,
            'approved_enabled' => 1,
            ]);
        DB::table('gs_forms')->insert([
            'name' => 'GS5b',
            'description' => 'Application for Research Award Transfer',
            'defaultStartMonth' => 12,
            'approved_enabled' => 1,
            ]);
        DB::table('gs_forms')->insert([
            'name' => 'GS6',
            'description' => 'Change of Circumstances',
            ]);
        DB::table('gs_forms')->insert([
            'name' => 'GS6a',
            'description' => 'Withdrawal from Programme of Study',
            'approved_enabled' => 1,
            ]);
        DB::table('gs_forms')->insert([
            'name' => 'GS6b',
            'description' => 'Change of Mode of Study',
            'approved_enabled' => 1,
            ]);
        DB::table('gs_forms')->insert([
            'name' => 'GS6c',
            'description' => 'Interruption of Study',
            'approved_enabled' => 1,
            ]);
        DB::table('gs_forms')->insert([
            'name' => 'GS6d',
            'description' => 'Extension to The Period of Study',
            'approved_enabled' => 1,
            ]);
        DB::table('gs_forms')->insert([
            'name' => 'GS6e',
            'description' => 'Change of Research Project Title',
            'approved_enabled' => 1,
            ]);
        DB::table('gs_forms')->insert([
            'name' => 'GS6f',
            'description' => 'Change in Supervisory Team',
            'approved_enabled' => 1,
            ]);
        DB::table('gs_forms')->insert([
            'name' => 'GS6g',
            'description' => 'Change of Programme of Study',
            'approved_enabled' => 1,
            ]);
        DB::table('gs_forms')->insert([
            'name' => 'GS7',
            'description' => 'Proposal for Thesis Examiners and Independent Chair',
            'defaultStartMonth' => 42,
            'approved_enabled' => 1,
            ]);
        DB::table('gs_forms')->insert([
            'name' => 'GS8',
            'description' => 'Candidate Thesis Submission Form',
            'defaultStartMonth' => 46,
            'approved_enabled' => 1,
            ]);
        DB::table('gs_forms')->insert([
            'name' => 'GS9',
            'description' => 'Examiners Initial Report on Thesis',
            'approved_enabled' => 1,
            ]);
        DB::table('gs_forms')->insert([
            'name' => 'GS10',
            'description' => 'Examiners Final Report on Thesis and Viva',
            'approved_enabled' => 1,
            ]);
        DB::table('gs_forms')->insert([
            'name' => 'GS10a',
            'description' => 'Examiners Approval of Thesis Amendments',
            'approved_enabled' => 1,
            ]);
        DB::table('gs_forms')->insert([
            'name' => 'GS11',
            'description' => 'Independent Viva Chair Report Form',
            'approved_enabled' => 1,
            ]);
        DB::table('gs_forms')->insert([
            'name' => 'GS12',
            'description' => 'Thesis Decision Confirmation of Award',
            'approved_enabled' => 1,
            ]);
        DB::table('gs_forms')->insert([
            'name' => 'GS13',
            'description' => 'Application for Thesis Pending Fees Status',
            'approved_enabled' => 1,
            ]);
    }
}
