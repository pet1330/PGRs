<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Supervisor;

class Staff extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'staff';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['university_email', 'room', 'about', 'position', 'university_phone'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function studentsSupervised()
    {
        return $this->hasMany('App\Supervisor');
    }

    public function directorOfStudyFor()
    {
        return $this->hasMany('App\Event', 'director_of_study_id');
    }

    public function secondSupervisorFor()
    {
        return $this->hasMany('App\Event', 'second_supervisor_id');
    }

    public function thirdSupervisorFor()
    {
        return $this->hasMany('App\Event', 'third_supervisor_id');
    }

    public function isMyStudent($id) {
        if (Supervisor::where('staff_id', $this->id)->where('student_id', $id)->where('end', NULL)->first()) {
            return true;
        }
        else {
            return false;
        }
    }
}
