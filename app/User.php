<?php

namespace App;

use App\Libraries\Traits\Keyable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Keyable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * RELATIONSHIPS
     */


    public function getFullnameAttribute()
    {
        return $this->lastname.' '.$this->firstname;
    }

    public function participate($survey_id)
    {
        return Answer::whereUserId($this->id)->whereSurveyId($survey_id)->count() > 0 ? 1 : 0;
    }

}
