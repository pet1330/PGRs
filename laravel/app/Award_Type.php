<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Award_Type extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'award_types';

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
