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
	
          if ($user->id <= 15) continue;
          	
          $link = route('show-survey-front' , array( Survey::createKey( array($survey->key, $user->key , $question->key) ) ));
            $result = route('results-survey-front' , array($survey->key, $user->key));
            Mail::send('mails.invitation', compact('survey', 'blueprint' , 'link' , 'user' , 'result'), function ($m) use ($survey, $blueprint, $user) {
                $m->from('nepasrepondre@ca-normandie-seine.fr', 'Crédit Agricole Normandie-Seine');
                $m->to($user->email)->subject("[Satisfaction collaborateur] ". utf8_decode($user->lastname).", donnez-nous votre avis ;)");
            });
        }

        $survey->update(array('sended' => 1));
        return redirect()->back()->with('success' , "Les emails ont été envoyés");
    }

    /**
     * List of contributors with unique link
     *
     * @param $survey_key
     */
    public function contributors($survey_key)
    {
        $survey = Survey::where('key', $survey_key)->first();
        $blueprint = Blueprint::findOrFail($survey->blueprint_id);
        $blueprint->load('Users');
        $question = Question::where('blueprint_id' , $survey->blueprint_id)->orderBy('order','ASC')->first();

        $html = view('surveys.contributors', compact('blueprint' , 'survey' , 'question'))->render();

        return response()->json(
            array(
                'html'      => $html
            )
        );

    }
}
