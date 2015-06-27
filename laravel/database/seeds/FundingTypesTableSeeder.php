<?php

use Illuminate\Database\Seeder;

class FundingTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('funding_types')->insert([
            'name' => 'Self funding',
            'description' => 'Students are funded by them-selves.',
        ]);
        DB::table('funding_types')->insert([
            'name' => 'Government sponsored',
            'description' => 'Students are funded by the Government',
        ]);
        DB::table('funding_types')->insert([
            'name' => 'UniL Scholarship',
            'description' => 'Students are funded by the University of Lincoln',
        ]);
        DB::table('funding_types')->insert([
            'name' => 'Project funded',
            'description' => 'Students are sponsored as a part of the project.',
        ]);
        DB::table('funding_types')->insert([
            'name' => 'Industry funding',
            'description' => 'Students are funded by the industry company.',
        ]);
    }
}
