<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('LevelTableSeeder');
        $this->call('UK_BA_StatusTableSeeder');
        $this->call('FundingTableSeeder');
        $this->call('StaffTableSeeder');
        $this->call('StudentsTableSeeder');

        Model::reguard();
    }
}
