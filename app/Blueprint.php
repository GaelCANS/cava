<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Blueprint extends Model
{


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
