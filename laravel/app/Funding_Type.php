<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funding_Type extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'funding_types';

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