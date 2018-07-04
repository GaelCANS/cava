<?php

namespace App\Http\Controllers;

use App\Blueprint;
use App\Question;
use App\Survey;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Mail;

class SurveyAdminController extends Controller
{

    /**
     * Display admin survey
     *
     * @param $blueprint_id
     * @return mixed
     */
    public function prepare($blueprint_id)
    {
        $blueprint = Blueprint::findOrFail($blueprint_id);
        $blueprint->load('Users');
        $users = $blueprint->Users;
        $surveys = Survey::where('blueprint_id',$blueprint_id)->orderBy('begin','ASC')->orderBy('end','ASC')->get();
        $first_survey = Survey::where('blueprint_id',$blueprint_id)->first();
        return view('surveys.prepare', compact('blueprint' , 'surveys' , 'users' , 'first_survey'));
        
    }

    /**
     * Send mail
     *
     * @param $survey_key
     */
    public function send($survey_key)
    {
        $survey = Survey::where('key', $survey_key)->first();
        $blueprint = Blueprint::findOrFail($survey->blueprint_id);
        $blueprint->load('Users');
        $question = Question::where('blueprint_id' , $survey->blueprint_id)->orderBy('order','ASC')->first();

        foreach ($blueprint->Users as $user) {

            $link = route('show-survey-front' , array( Survey::createKey( array($survey->key, $user->key , $question->key) ) ));
            Mail::send('mails.invitation', compact('survey', 'blueprint' , 'link' , 'user'), function ($m) use ($survey, $blueprint, $user) {
                $m->from('nepasrepondre@cava.com', 'Ca va ?');
                $m->to($user->email)->subject("Vous êtes invité à donner votre avis.");
            });
        }

        $survey->update(array('sended' => 1));

    }
}
