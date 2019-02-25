<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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


    public static function participants($survey_id, $period = array(), $room = "")
    {
        $query = DB::table('answers')->select(DB::raw('COUNT(DISTINCT(user_id)) as user_count'));

        if ($room != "") {
            $query->join('users' , 'users.id' , '=' , 'answers.user_id')->where('users.room' , '=' , $room);
        }

        if (count($period) != 0) {
            $where = array();
            $where[] = array('answers.created_at', '>=' , $period['begin']);
            $where[] = array('answers.created_at', '<=' , $period['end']);
            $query->where($where);
        }

        $participants = $query->whereSurveyId($survey_id)->first();

        return $participants->user_count;
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
    public static function averageQuestionSurvey($survey_id, $question_id , $period = array(), $room = "")
    {

        $where = array(
            array('answers.survey_id' , $survey_id),
            array('answers.question_id',$question_id)
        );

        if (count($period) > 0) {
            $where[] = array('answers.created_at', '>=', $period['begin']);
            $where[] = array('answers.created_at', '<=', $period['end']);
        }

        $query = self::where($where);

        if ($room != "") {
            $query->join('users' , 'users.id' , '=' , 'answers.user_id')->where('users.room' , '=' , $room);
        }

        return round(
            $query  ->positive()
                    ->avg('result')
            ,1
        );

        return round(
            self::where($where)
                ->positive()
                ->avg('result')
            ,1
        );

    }


    /**
     * Returns the average on a question
     *
     * @param $question_id
     * @return float
     */
    public static function averageQuestion($question_id)
    {
        //return round(self::where('question_id',$question_id)->positive()->avg('result'),1);
        $number_average = 0;
        $averages = DB::select("SELECT AVG(`result`) AS average FROM answers WHERE question_id = :question_id AND result >= 0 GROUP BY survey_id" , array('question_id' => $question_id) );
        if (count($averages) > 0 ) {
            foreach ($averages as $average) {
                $number_average += $average->average;
            }
            $number_average = round($number_average/count($averages),1);
        }
        return $number_average;
    }


    public static function SPELN_oneYearStat($question_id, $room="")
    {
        $query = self::select(
                        DB::raw("ROUND(AVG(answers.result),2) AS note") ,
                        DB::raw("CONCAT(YEAR(answers.created_at),'-',LPAD(MONTH(answers.created_at),2,'0')) AS periode"));
        
        if ($room != "") {
            $query->join('users' , 'users.id' , '=' , 'answers.user_id')->where('users.room' , '=' , $room);
        }

        return $query->where(
            array(
                array(
                    "answers.question_id" , "=" , $question_id
                ),
                array(
                    "answers.created_at" , ">" , Carbon::now()->subYear(1)->format('Y-m-d 00:00:01')
                )
            ))
            ->positive()
            ->groupBy(DB::raw("CONCAT(YEAR(answers.created_at),'-',MONTH(answers.created_at))"))
            ->get();
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

    /**
     * RELATIONSHIPS
     */
    public function question() {
        return $this->belongsTo('App\Question');
    }

}
