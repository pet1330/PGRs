<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
   /**
     * The database table used by the model.
     *
     * @var string
     */
   protected $table = 'supervisors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['student_id',
    'staff_id',
    'order',
    'start',
    'end',
    ];

    public function student()
    {
    	return $this->belongsTo('App\Student', 'student_id');
    }

    public function staff()
    {
    	return $this->belongsTo('App\Staff', 'staff_id');
    }
}