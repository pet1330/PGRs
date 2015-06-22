<?php

use Illuminate\Database\Seeder;

class FundingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('funding')->insert([
            'name' => 'Self funding',
            'comments' => 'Students are funded by them-selves.',
        ]);
        DB::table('funding')->insert([
            'name' => 'Government sponsored',
            'comments' => 'Students are funded by the Government',
        ]);
        DB::table('funding')->insert([
            'name' => 'UniL Scholarship',
            'comments' => 'Students are funded by the University of Lincoln',
        ]);
        DB::table('funding')->insert([
            'name' => 'Project funded',
            'comments' => 'Students are sponsored as a part of the project.',
        ]);
        DB::table('funding')->insert([
            'name' => 'Industry funding',
            'comments' => 'Students are funded by the industry company.',
        ]);
    }
}
