<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

use App\Event;

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

    public function scopeEntityCount($query, $attribute, $id){
        return $query->where($attribute, $id);
    }

    public function calculateEnd()
    {  
        //full time
        if ($this->mode_of_study->id == 1) {
            $this->attributes['end'] = Carbon::parse($this->start)->addYears(4);
        }
        //part time: times 1.5x
        elseif ($this->mode_of_study->id == 2) {
            $this->attributes['end'] = Carbon::parse($this->start)->addYears(6);
        }
        return $this;
    }

    public function getCurrentYearAttribute()
    {
        return Carbon::parse($this->start)->age + 1;
    }

    public function getTimeSinceLastGS5Attribute()
    {
        $latestGS5 = Event::with('gs_form')->where('student_id', $this->id)->where('gs_form_id', 5)->orderBy('approved_at', 'desc')->first();

        if ($latestGS5 == NULL) {
            return NULL;
        }
        else {
            return Carbon::parse($latestGS5->approved_at)->diffForHumans();
        }
    }
}