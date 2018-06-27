<?php

namespace App;

use App\Libraries\Traits\Keyable;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use Keyable;

    protected $guarded = array('id');

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


    /**
     * Return question sort by asc, and if question is answered
     *
     * @param $survey_id
     * @param $user_id
     * @return array
     */
    public static function navigation($survey_id, $user_id)
    {
        $survey          = Survey::findOrFail($survey_id);
        $user            = User::findOrFail($user_id);
        $surveyQuestions = self::questions($survey->blueprint_id);
        $questions       = array();
        foreach ($surveyQuestions as $surveyQuestion) {
            $questions[] = array(
                'order'     => $surveyQuestion->order,
                'key'       => $surveyQuestion->key,
                'answered'  => Answer::isAnswered($survey_id, $user_id, $surveyQuestion->id),
                'link'      => Survey::createKey(array( $survey->key , $user->key , $surveyQuestion->key ))
            );
        }
        return $questions;
    }

    /**
     * Return all questions from a blueprint
     *
     * @param $blueprint_id
     * @return mixed
     */
    public static function questions($blueprint_id)
    {
        return self::where('blueprint_id' , $blueprint_id)->orderBy('order' , 'asc')->get();
    }


}
