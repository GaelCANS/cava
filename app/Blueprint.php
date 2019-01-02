<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Blueprint extends Model
{

    protected $guarded = array('id');


    public function getGuestsAttribute()
    {
        return User::whereBlueprintId($this->id)->count();
    }

    public static function setBeginEnd($id)
    {
        $begin  = Survey::where('blueprint_id',$id)->min('begin');
        $end    = Survey::where('blueprint_id',$id)->max('end');
        $blueprint = Blueprint::findOrFail($id);
        $blueprint->begin = $begin;
        $blueprint->end = $end;
        $blueprint->save();
    }

    public function getSpeLNAttribute()
    {
        return $this->id == env('SPE_LN');
    }


    /**
     * RELATIONSHIPS
     */
    public function questions() {
        return $this->hasMany('App\Question');
    }


    public function users() {
        return $this->hasMany('App\User');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function getPeriodAttribute()
    {
        $begin  = Carbon::createFromFormat('Y-m-d', $this->begin)->format('d/m/Y');
        $end    = Carbon::createFromFormat('Y-m-d', $this->end)->format('d/m/Y');
        return $begin.' - '.$end;
    }
}
