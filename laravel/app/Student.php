<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

use App\Event;
use App\Supervisor;
use App\GS_Form;

use Setting;

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
        //full time from globalSettings.php
        if ($this->mode_of_study->id == 1) {
            $this->attributes['end'] = Carbon::parse($this->start)->addYears(Setting::get('fullTimeDefaultStudyDuration'));
        }
        //part time and distance learning
        elseif ($this->mode_of_study->id == 2 || $this->mode_of_study->id == 3) {
            $this->attributes['end'] = Carbon::parse($this->start)->addYears(Setting::get('fullTimeDefaultStudyDuration') * Setting::get('partTimeDefaultStudyDurationMultiplier'));
        }
        return $this;
    }

    public function getCurrentYearAttribute()
    {
        return Carbon::parse($this->start)->age + 1;
    }

    public function getTimeSinceLastGS5Attribute()
    {
        $latestGS5 = Event::with('gs_form')->where('student_id', $this->id)->where('gs_form_id', 5)->whereNotNull('approved_at')->orderBy('approved_at', 'desc')->first();

        if ($latestGS5 == NULL) {
            return NULL;
        }
        else {
            return Carbon::parse($latestGS5->approved_at)->diffForHumans();
        }
    }

    public function currentSupervisorId($order)
    {
        $dos = Supervisor::with('staff')->where('student_id', $this->id)->where('order', $order)->whereNull('end')->first();
        if ($dos == NULL) {
            return NULL;
        }
        else
        {
            return $dos->staff_id;
        }
    }

    public function existingCurrentSupervisor($order)
    {
        return Supervisor::with('staff.user')->where('order', $order)->where('student_id', $this->id)->whereNull('end')->first();
    }

    public function autoGenerateGS5s()
    {
        if ($this->mode_of_study_id == 1 || $this->mode_of_study_id == 2 || $this->mode_of_study->id == 3) {
            if ($this->end) {
                $current_director_of_study_id = $this->currentSupervisorId(1);
                $current_second_supervisor_id = $this->currentSupervisorId(2);
                $current_third_supervisor_id = $this->currentSupervisorId(3);
                $gs5Count = 0;
                for ($i=0; $i < Carbon::parse($this->start)->diffInYears(Carbon::parse($this->end)); $i++)
                {
                    $created_at = Carbon::parse($this->start)->addMonths((12*($i+1)))->toDateTimeString();
                    if ($created_at < $this->end) {
                        $event['student_id'] = $this->id;
                        $event['gs_form_id'] = 5;
                        $event['comments'] = 'This GS5 was automatically generated.';
                        if ($current_director_of_study_id) {
                            $event['director_of_study_id'] = $current_director_of_study_id;
                        }
                        if ($current_second_supervisor_id) {
                            $event['second_supervisor_id'] = $current_second_supervisor_id;
                        }
                        if ($current_third_supervisor_id) {
                            $event['third_supervisor_id'] = $current_third_supervisor_id;
                        }
                        $event['created_at'] = $created_at;
                        $event['start'] = Carbon::parse($created_at)->subDays(Setting::get('defaultEventDuration'));
                        $event['end'] = Carbon::parse($created_at)->addDays(Setting::get('defaultEventDuration'));
                        $newEvent = Event::create($event);
                        $gs5Count++;
                    }
                }
                return $gs5Count;
            }
            else { return 'noEND'; }
        }
        else { return 'notFTorPT'; }
    }

    public function autoGenerateSingleEvent($eventName)
    {
        try {
            $gs_form = GS_Form::where('name', $eventName)->first();
            $current_director_of_study_id = $this->currentSupervisorId(1);
            $current_second_supervisor_id = $this->currentSupervisorId(2);
            $current_third_supervisor_id = $this->currentSupervisorId(3);
            $event['student_id'] = $this->id;
            $event['gs_form_id'] = $gs_form->id;
            $event['comments'] = 'This '.$eventName.' was automatically generated.';
            if ($current_director_of_study_id) {
                $event['director_of_study_id'] = $current_director_of_study_id;
            }
            if ($current_second_supervisor_id) {
                $event['second_supervisor_id'] = $current_second_supervisor_id;
            }
            if ($current_third_supervisor_id) {
                $event['third_supervisor_id'] = $current_third_supervisor_id;
            }
            if (($eventName == 'GS7' || $eventName == 'GS8') && $this->mode_of_study->name == 'Part time') {
                $created_at = Carbon::parse($this->start)->addMonths($gs_form->defaultStartMonth*Setting::get('partTimeDefaultStudyDurationMultiplier'))->toDateTimeString();
            }
            else {
                $created_at = Carbon::parse($this->start)->addMonths($gs_form->defaultStartMonth)->toDateTimeString();
            }
            $event['created_at'] = $created_at;
            $event['start'] = Carbon::parse($created_at)->subDays(Setting::get('defaultEventDuration'));
            $event['end'] = Carbon::parse($created_at)->addDays(Setting::get('defaultEventDuration'));
            $newEvent = Event::create($event);
            return 'DONE';
        } catch (Exception $e) {
            return 'EXCEPTION';
        }
    }

    public function autoGenerateAllEvents()
    {
        $response = $this->autoGenerateSingleEvent('GS3');
        $response = $this->autoGenerateGS5s();
        $response = $this->autoGenerateSingleEvent('GS5b');
        $response = $this->autoGenerateSingleEvent('GS7');
        $response = $this->autoGenerateSingleEvent('GS8');
    }
}