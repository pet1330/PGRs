<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student_Status_History extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'student_status_history';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['student_id', 'enrolment_status_id', 'created_at'];

    public function student()
    {
        return $this->belongsTo('App\Student', 'student_id');
    }

    public function enrolment_status()
    {
        return $this->belongsTo('App\Enrolment_Status');
    }
}
