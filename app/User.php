<?php

namespace App;

use App\Libraries\Traits\Keyable;
use Carbon\Carbon;
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


    public function getFullnameAttribute()
    {
        return $this->lastname.' '.$this->firstname;
    }
    public function getCreatedAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d/m/Y');
    }

    public function participate($survey_id)
    {
        return Answer::whereUserId($this->id)->whereSurveyId($survey_id)->count() > 0 ? 1 : 0;
    }

    public function getAnswersAttribute() {
        return Answer::whereUserId($this->id)->count();
    }

}
