<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
   /**
     * The database table used by the model.
     *
     * @var string
     */
   protected $table = 'history';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'student_id',
    'staff_id',
    'created_by',
    'title',
    'content',
    'created',
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
