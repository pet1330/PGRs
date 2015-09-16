<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Event;

class GS_Form extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'gs_forms';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'defaultStartMonth', 'approved_enabled'];

    public function getNameAndDescriptionAttribute()
    {
        return trim(implode(' ', array($this->attributes['name'], $this->attributes['description'])), ' ');
    }

    public function isInUse()
    {
        if (Event::where('gs_form_id', $this->id)->first()) {
            return true;
        }
        else{
            return false;
        }
    }
}
