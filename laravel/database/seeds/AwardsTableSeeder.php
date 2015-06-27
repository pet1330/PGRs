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
            'description' => 'Master of Science degree',
        ]);
        DB::table('awards')->insert([
            'name' => 'MPhil',
            'description' => 'Master of Philosophy Degree',
        ]);
        DB::table('awards')->insert([
            'name' => 'PhD',
            'description' => 'Doctor of Philosophy Degree',
        ]);
    }
}
