<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PageController extends Controller
{

    public static function page404()
    {
        return view('pages.404');
    }

    public static function pageSurveyFinish()
    {
        return view('pages.finish');
    }

    public static function pageSurveyAnswered()
    {
        return view('pages.answered');
    }
}
