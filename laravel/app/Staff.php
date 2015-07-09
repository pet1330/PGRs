<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
