<?php

namespace App;

use App\Libraries\Traits\Keyable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Survey extends Model
{
    use Keyable;

    public $guarded = array('id');


    /**
     * MUTATORS & ACCESSORS
     */
    public function getBeginshortAttribute() {
        if (empty($this->begin)) return '';
        return $this->begin != '0000-00-00' ?
            Carbon::createFromFormat('Y-m-d', $this->begin)->format('d/m/y') :
            '';
    }

    public function getBeginlongAttribute() {
        if (empty($this->begin)) return '';
        return $this->begin != '0000-00-00' ?
            Carbon::createFromFormat('Y-m-d', $this->begin)->format('d/m/Y') :
            '';
    }

    public function getEndshortAttribute() {
        if (empty($this->end)) return '';
        return $this->end != '0000-00-00' ?
            Carbon::createFromFormat('Y-m-d', $this->end)->format('d/m/y') :
            '';
    }

    public function getEndlongAttribute() {
        if (empty($this->end)) return '';
        return $this->end != '0000-00-00' ?
            Carbon::createFromFormat('Y-m-d', $this->end)->format('d/m/Y') :
            '';
    }

    public function getSendedAtAttribute($value) {
        if (empty($value)) return ' - ';
        return $value != '0000-00-00 00:00:00' ?
            Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y') :
            ' - ';
    }

    public function getDureeAttribute()
    {
        if ($this->begin == "0000-00-00" || $this->end == '0000-00-00' || $this->begin == '' || $this->end == '') return false;
        $begin = Carbon::createFromFormat('Y-m-d', $this->begin);
        $end = Carbon::createFromFormat('Y-m-d', $this->end);
        return $begin->diffInDays($end);
    }

    public function getPeriodAttribute()
    {
        return $this->beginshort.' - '.$this->endshort;
    }

    public function getGuestsAttribute()
    {
        return Answer::participants($this->id);
    }

    public function getCurrentAttribute()
    {
        if ($this->begin == "0000-00-00" || $this->end == '0000-00-00' || $this->begin == '' || $this->end == '') return false;
        $begin = Carbon::createFromFormat('Y-m-d', $this->begin);
        $end = Carbon::createFromFormat('Y-m-d', $this->end);

        return $begin->isPast() && $end->isFuture();
    }

    public static function setDate($date)
    {
        return Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
    }


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
    public static function evolutionQuestion($blueprint_id, $user_id, $question_id, $period = array())
    {
        $surveyQuestions = array('average' => array() , 'user' => array());
        $surveys = Survey::where('blueprint_id' , $blueprint_id)->where('sended' , '1')->orderBy('begin','ASC')->get();
        if ($surveys) {
            foreach ($surveys as $survey) {
                $surveyQuestions['average'][] = Answer::averageQuestionSurvey($survey->id,$question_id , $period);
                if ($user_id != 'admin')
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
