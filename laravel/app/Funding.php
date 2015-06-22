<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funding extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'funding';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'comments'];

    public function student()
    {
		return $this->hasMany('App\Student');
	}
}