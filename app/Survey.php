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


    /**
     * Return an array with averages for each questions
     *
     * @param $survey
     * @return array
     */
    public static function results($survey)
    {
        $surveyQuestions = Question::questions($survey->blueprint_id);
        $questions = array();
        foreach ($surveyQuestions as $surveyQuestion) {
            if ($surveyQuestion->type == "close") {
                $questions[] = array(
                    'survey_avg' => Answer::averageQuestionSurvey($survey->id,$surveyQuestion->id),
                    'avg'        => Answer::averageQuestion($surveyQuestion->id),
                    'comment'    => $surveyQuestion->comment,
                    'wording'    => $surveyQuestion->wording,
                    'key'        => $surveyQuestion->key,
                    'order'      => $surveyQuestion->order
                );
            }
        }

        return $questions;
    }


    /**
     * Return an array containing the evolutions of averages
     *
     * @param $blueprint_id
     * @param $user_id
     * @param $question_id
     * @return array
     */
    public static function evolutionQuestion($blueprint_id, $user_id, $question_id)
    {
        $surveyQuestions = array();
        $surveys = Survey::where('blueprint_id' , $blueprint_id)->where('sended' , '1')->orderBy('begin','ASC')->get();
        if ($surveys) {
            foreach ($surveys as $survey) {
                $surveyQuestions['average'][] = Answer::averageQuestionSurvey($survey->id,$question_id);
                $surveyQuestions['user'][] = Answer::answerUser($survey->id , $user_id, $question_id);
            }
        }
        return $surveyQuestions;
    }



    /**
     * RELATIONSHIPS
     */
    public function blueprint() {
        return $this->belongsTo('App\Blueprint');
    }
}
