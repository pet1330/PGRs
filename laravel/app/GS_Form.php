<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GS_Form extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'gs_forms';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description'];
}
