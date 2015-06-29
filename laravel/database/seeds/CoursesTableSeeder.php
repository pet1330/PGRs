<?php

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->insert([
            'name' => 'Computer Science',
            'description' => 'Computer science is the scientific and practical approach to computation and its applications.',
        ]);
    }
}
