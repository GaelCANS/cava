<?php

namespace App\Http\Middleware;

use App\Answer;
use App\Question;
use App\Survey;
use App\User;
use Closure;

class SurveyIsAlreadyAnswered
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $keys = Survey::explodeKeys($request->route('key'));
        $survey = Survey::findOrFail(Survey::getId($keys['survey']));

        if (Question::where('blueprint_id' , $survey->blueprint_id)->count() > Answer::where('survey_id' , $survey->id)->where('user_id',User::getId($keys['user']))->count())
            return $next($request);
        else
            return view('pages.answered' , array('survey_key' => $keys['survey'] , 'user_key' => $keys['user']) );
    }
}
