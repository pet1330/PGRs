<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'key' => 'fullTimeDefaultStudyDuration',
            'value' => '4',
        ]);
        DB::table('settings')->insert([
            'key' => 'partTimeDefaultStudyDurationMultiplier',
            'value' => '1.5',
        ]);
        DB::table('settings')->insert([
            'key' => 'upcomingEventsTimeFrame',
            'value' => '6',
        ]);
        DB::table('settings')->insert([
            'key' => 'enableAutomaticHistoryEntires',
            'value' => 'true',
        ]);
    }
}
