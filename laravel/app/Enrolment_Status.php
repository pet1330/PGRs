<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enrolment_Status extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'enrolment_status';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public function student()
    {
		return $this->hasMany('App\Student');
	}
}
