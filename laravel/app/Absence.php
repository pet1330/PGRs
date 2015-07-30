<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
     protected $table = 'absences';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'absence_type_id',
    'student_id',
    'start',
    'end',
    'description'
    ];

    public function student()
    {
    	return $this->belongsTo('App\Student', 'student_id');
    }

    public function absence_type()
    {
    	return $this->belongsTo('App\Absence_Type', 'absence_type_id');
    }
}
