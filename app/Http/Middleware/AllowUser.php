<?php

namespace App\Http\Middleware;

use App\Survey;
use App\User;
use Closure;

class AllowUser
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
        $survey = Survey::findOrFail($keys['survey']);

        if (User::where('key', $keys['user'])->where('blueprint_id' , $survey->blueprint_id)->count())
            return $next($request);
        else
            return view('pages.404');
    }
}
