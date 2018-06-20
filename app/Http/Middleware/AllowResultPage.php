<?php

namespace App\Http\Middleware;

use App\Survey;
use Closure;

class AllowResultPage
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
        if (Survey::where('key',$request->route('survey_key'))->count() > 0)
            return $next($request);
        else
            return view('pages.404');
    }
}
