<?php

namespace App\Libraries\Traits;


trait Keyable
{

    /**
     * Return ID by key
     *
     * @param $key
     * @return int
     */
    public static function getId( $key ) {
        $object = self::where('key',$key)->first();
        return $object->id;
    }

}