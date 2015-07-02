<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mode_Of_Study extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'modes_of_study';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description'];

    public function student()
    {
		return $this->hasMany('App\Student');
	}

}
