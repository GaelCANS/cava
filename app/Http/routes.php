<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


// Survey
Route::get('/survey/{key}','SurveyController@question')->name('show-survey-front');
Route::post('/survey/{key}','SurveyController@answer')->name('answer-survey-front');
Route::get('/results/{key}','SurveyController@results')->name('results-survey-front');


// Page
Route::get('/404','PagesController@page404')->name('page-404');
Route::get('/finish/{key}','PagesController@pageSurveyFinish')->name('page-finish');
Route::get('/404','PagesController@pageSurveyAnswered')->name('page-answered');