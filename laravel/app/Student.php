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
                            'enrolment',
                            'gender',
                            'home_address',
                            'current_address',
                            'nationality',
                            'start',
                            'end',
                            'ukba_status_id',
                            'funding_type_id',
                            'award_id',
                            'award_type_id',
                            'enrolment_status_id'
                            ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function award()
    {
        return $this->belongsTo('App\Award');
    }

    public function award_type()
    {
        return $this->belongsTo('App\Award_Type');
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

    public function scopeAwardTypeCount($query, $id){
        return $query->where('award_type_id', $id);
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