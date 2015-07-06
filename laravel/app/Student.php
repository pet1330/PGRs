<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'students';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['dob',
    'award_id',
    'course_id',
    'current_address',
    'end',
    'enrolment',
    'enrolment_status_id',
    'funding_type_id',
    'gender',
    'home_address',
    'image',
    'mode_of_study_id',
    'nationality',
    'start',
    'ukba_status_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function award()
    {
        return $this->belongsTo('App\Award');
    }

    public function mode_of_study()
    {
        return $this->belongsTo('App\Mode_Of_Study');
    }

    public function absence_type()
    {
        return $this->belongsTo('App\Absence_Type');
    }

    public function funding_type()
    {
        return $this->belongsTo('App\Funding_Type');
    }

    public function ukba_status()
    {
        return $this->belongsTo('App\UKBA_Status');
    }

    public function enrolment_status()
    {
        return $this->belongsTo('App\Enrolment_Status');
    }

    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function history()
    {
        return $this->hasMany('App\History');
    }

    public function supervisors()
    {
        return $this->hasMany('App\Supervisor');
    }

    public function scopeModeOfStudyCount($query, $id){
        return $query->where('mode_of_study_id', $id);
    }

    public function scopeAwardCount($query, $id){
        return $query->where('award_id', $id);
    }

    public function scopeEnrolmentStatusCount($query, $id){
        return $query->where('enrolment_status_id', $id);
    }

    public function scopeFundingTypeCount($query, $id){
        return $query->where('funding_type_id', $id);
    }

    public function scopeEntityCount($query, $attribute, $id){
        return $query->where($attribute, $id);
    }
}