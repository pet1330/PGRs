<?php

use Illuminate\Database\Seeder;

class LevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('level')->insert([
            'name' => 'MSc',
            'comments' => 'Master of Science degree',
        ]);
        DB::table('level')->insert([
            'name' => 'MSc (PT)',
            'comments' => 'Master of Science degree (Part Time)',
        ]);
        DB::table('level')->insert([
            'name' => 'MSc (DL)',
            'comments' => 'Master of Science degree (Distance Learning)',
        ]);
        DB::table('level')->insert([
            'name' => 'MPhil',
            'comments' => 'Master of Philosophy Degree',
        ]);
        DB::table('level')->insert([
            'name' => 'MPhil (PT)',
            'comments' => 'Master of Philosophy Degree (Part Time)',
        ]);
        DB::table('level')->insert([
            'name' => 'MPhil (DL)',
            'comments' => 'Master of Philosophy Degree (Distance Learning)',
        ]);
        DB::table('level')->insert([
            'name' => 'PhD',
            'comments' => 'Doctor of Philosophy Degree',
        ]);
        DB::table('level')->insert([
            'name' => 'PhD (PT)',
            'comments' => 'Doctor of Philosophy Degree (Part Time)',
        ]);
        DB::table('level')->insert([
            'name' => 'PhD (DL)',
            'comments' => 'Doctor of Philosophy Degree (Distance Learning)',
        ]);
    }
}
