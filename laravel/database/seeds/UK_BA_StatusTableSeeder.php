<?php

use Illuminate\Database\Seeder;

class UKBA_StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ukba_status')->insert([
            'name' => 'UK',
            'description' => 'Citizens of the United Kingdom',
        ]);
        DB::table('ukba_status')->insert([
            'name' => 'EU',
            'description' => 'Citizens of the European Union',
        ]);
        DB::table('ukba_status')->insert([
            'name' => 'International',
            'description' => 'International students',
        ]);
        DB::table('ukba_status')->insert([
            'name' => 'Foreign',
            'description' => 'International students',
        ]);
    }
}
