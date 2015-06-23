<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'staff';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['university_email', 'room', 'about', 'position', 'university_phone'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
