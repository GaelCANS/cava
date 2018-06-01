<?php

namespace App;

use App\Libraries\Traits\Keyable;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use Keyable;

    public $guarded = array('id');

    /**
     * CUSTOM
     */

    /**
     * Try to return an array with the uniqid for each one
     *
     * @param $key : keys from URL, normaly contains uniqid for survey - uniqid for user - uniqid for question
     * @return array|bool
     */
    public static function explodeKeys($key)
    {
        $keys = explode('-',$key);
        return count($keys) == 3 ? array('survey' => $keys[0] , 'user' => $keys[1] , "question" => $keys[2]) : false;
    }


    /**
     * Return key with differents keys
     *
     * @param $keys : survey key, user key, question key
     * @return string
     */
    public static function createKey($keys)
    {
        return implode('-',$keys);
    }
    
    
    
    public static function countQuestion()
    {
        
    }



    /**
     * RELATIONSHIPS
     */
    public function blueprint() {
        return $this->belongsTo('App\Blueprint');
    }
}
