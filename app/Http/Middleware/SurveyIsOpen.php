<?php

namespace App\Http\Middleware;

use App\Survey;
use Carbon\Carbon;
use Closure;

class SurveyIsOpen
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
        $survey = Survey::where('key' , $keys['survey'])
                    ->where('begin' , '<=' , Carbon::now())
                    ->where('end' , '>=' , Carbon::now())
                    ->where('sended' , '1')
                    ->count();

        if ($survey > 0)
            return $next($request);
        else {
            $survey = Survey::where('key' , $keys['survey'])->first();
            return view('pages.finish', array('survey_key' => $keys['survey'], 'user_key' => $keys['user'] , 'survey' => $survey));
        }
    }
}
