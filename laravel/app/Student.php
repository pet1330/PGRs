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
    protected $fillable = ['dob', 'enrolment', 'gender', 'home_address', 'current_address', 'nationality', 'start', 'end'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function level()
    {
        return $this->belongsTo('App\Level');
    }

    public function funding()
    {
        return $this->belongsTo('App\Funding');
    }

    public function uk_ba_status()
    {
        return $this->belongsTo('App\UK_BA_Status');
    }
}