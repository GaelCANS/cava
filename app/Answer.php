<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public $guarded = array('id');

    /**
     * Return if a question has been answered
     *
     * @param $survey_id
     * @param $user_id
     * @param $question_id
     * @return int
     */
    public static function isAnswered($survey_id , $user_id , $question_id)
    {
        return self::where('survey_id' , $survey_id)->where('user_id',$user_id)->where('question_id',$question_id)->count();
    }
}
