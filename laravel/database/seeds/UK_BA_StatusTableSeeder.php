<?php

use Illuminate\Database\Seeder;

class UK_BA_StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('uk_ba_status')->insert([
            'name' => 'UK',
            'comments' => 'Citizens of the United Kingdom',
        ]);
        DB::table('uk_ba_status')->insert([
            'name' => 'EU',
            'comments' => 'Citizens of the European Union',
        ]);
        DB::table('uk_ba_status')->insert([
            'name' => 'International',
            'comments' => 'International students',
        ]);
        DB::table('uk_ba_status')->insert([
            'name' => 'Foreign',
            'comments' => 'International students',
        ]);
    }
}
