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
    protected $fillable = [
        'name', 'email', 'password',
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
}
