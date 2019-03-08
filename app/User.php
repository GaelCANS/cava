<?php

namespace App;

use App\Libraries\Traits\Keyable;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

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


    public static function convertCsvToArray($file)
    {
        $csv = $file['file']->getRealPath();
        $users = array();

        if (($handle = fopen($csv, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if (trim($data[0]) != '' && filter_var($data[0], FILTER_VALIDATE_EMAIL)) {
                    $users[] = $data[0];
                }
            }
            fclose($handle);
        }

        return $users;
    }

    public static function parseEmail($email)
    {
        $parsed = explode('@',$email);
        $fullname = explode('.',$parsed[0]);
        return array(
            'firstname' => $fullname[0],
            'lastname'  => isset($fullname[1]) ? $fullname[1] : "",
            'email'     => $email
        );
    }


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

    /*public function getSuperadminAttribute()
    {
        return $this->superadmin == 1 ? true : false;
    }*/

    public static function statsPerRooms()
    {
        return self::select(DB::raw('COUNT(*) AS combien'),'room')->where('room','!=','')->groupBy('room')->get();
    }

}
