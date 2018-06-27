<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public $guarded = array('id');


    /**
     * SCOPES
     */
    public function scopePositive($query)
    {
        return $query->where('result' , '>=' , 0);
    }
    

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


    /**
     * Returns the average on a question since the beginning of the survey
     *
     * @param $survey_id
     * @param $question_id
     * @return float
     */
    public static function averageQuestionSurvey($survey_id, $question_id)
    {
        return round(self::where('survey_id' , $survey_id)->where('question_id',$question_id)->positive()->avg('result'),1);
    }


    /**
     * Returns the average on a question
     *
     * @param $question_id
     * @return float
     */
    public static function averageQuestion($question_id)
    {
        return round(self::where('question_id',$question_id)->positive()->avg('result'),1);
    }


    /**
     * Return Answer question for an user and a survey
     *
     * @param $survey_id
     * @param $user_id
     * @param $question_id
     */
    public static function answerUser($survey_id, $user_id, $question_id)
    {
        $answer = self::where('survey_id' , $survey_id)->where('user_id',$user_id)->where('question_id',$question_id)->first();
        return self::isAnswered($survey_id, $user_id, $question_id) > 0 && $answer->result >= 0 ? (float)$answer->result : '';
    }

}
