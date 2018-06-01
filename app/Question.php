<?php

namespace App;

use App\Libraries\Traits\Keyable;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use Keyable;

    /**
     * CUSTOM
     */

    /**
     * Return key from the previous question
     *
     * @param $current : current question
     * @return object|bool
     */
    public static function previous($current)
    {
        if ($current->order > 1) {
            $question = Question::where('blueprint_id' , $current->blueprint_id)->where('order' , $current->order-1)->first();
            return $question->key;
        }
        else {
            return false;
        }
    }

    /**
     * Return key from the next question
     *
     * @param $current : current question
     * @return object|bool
     */
    public static function next($current)
    {
        $countQuestion = Question::where('blueprint_id' , $current->blueprint_id)->count();
        if ($current->order < $countQuestion) {
            $question = Question::where('blueprint_id' , $current->blueprint_id)->where('order' , $current->order+1)->first();
            return $question->key;
        }
        else {
            return false;
        }
    }


}
