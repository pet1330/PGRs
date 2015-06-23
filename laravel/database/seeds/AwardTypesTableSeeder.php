<?php

use Illuminate\Database\Seeder;

class AwardTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('award_types')->insert(['name' => 'Full time']);
        DB::table('award_types')->insert(['name' => 'Part time']);
        DB::table('award_types')->insert(['name' => 'Distance learning']);
    }
}
