<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blueprint extends Model
{


    /**
     * RELATIONSHIPS
     */
    public function questions() {
        return $this->hasMany('App\Question');
    }
}
