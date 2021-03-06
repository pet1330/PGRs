<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use \App\Student;
use \App\User;

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

        $this->call('SettingsTableSeeder');
        
        $this->call('AbsenceTypesTableSeeder');
        $this->call('AwardsTableSeeder');
        $this->call('ModesOfStudyTableSeeder');
        $this->call('CoursesTableSeeder');
        $this->call('EnrolmentStatusTableSeeder');
        $this->call('FundingTypesTableSeeder');
        $this->call('UKBA_StatusTableSeeder');
        $this->call('GSFormsTableSeeder');

        $this->call('StaffTableSeeder');
        $this->call('StudentsTableSeeder');
        $this->call('SupervisorsTableSeeder');
        $this->call('RolesAndPermissionsSeeder');
        
        $this->call('EventsTableSeeder');

        Model::reguard();
    }
}
