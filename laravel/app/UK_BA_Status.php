<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UK_BA_Status extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'uk_ba_status';

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
