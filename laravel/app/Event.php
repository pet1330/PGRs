<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'events';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['student_id', 'gs_form_id', 'exp_start', 'exp_end', 'submitted_at', 'approved_at', 'comments', 'director_of_study_id', 'second_supervisor_id', 'third_supervisor_id', 'created_at'];

    public function student()
    {
    	return $this->belongsTo('App\Student', 'student_id');
    }

    public function directorOfStudy()
    {
    	return $this->belongsTo('App\Staff', 'director_of_study_id');
    }

    public function secondSupervisor()
    {
    	return $this->belongsTo('App\Staff', 'second_supervisor_id');
    }

    public function thirdSupervisor()
    {
    	return $this->belongsTo('App\Staff', 'third_supervisor_id');
    }

    public function gs_form()
    {
    	return $this->belongsTo('App\GS_Form', 'gs_form_id');
    }
}
