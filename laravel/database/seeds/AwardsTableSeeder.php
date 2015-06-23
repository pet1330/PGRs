<?php

use Illuminate\Database\Seeder;

class AwardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('awards')->insert([
            'name' => 'MSc',
            'comments' => 'Master of Science degree',
        ]);
        DB::table('awards')->insert([
            'name' => 'MPhil',
            'comments' => 'Master of Philosophy Degree',
        ]);
        DB::table('awards')->insert([
            'name' => 'PhD',
            'comments' => 'Doctor of Philosophy Degree',
        ]);
    }
}
