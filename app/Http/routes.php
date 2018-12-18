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
Route::get('/results/{survey_key}/{user_key?}','SurveyController@results')->name('results-survey-front');
Route::get('/graph/{blueprint}/{user_key}/{question_key}','SurveyController@evolution')->name('evolution');
Route::get('/comments/{survey_key}','SurveyController@comments')->name('comments');
Route::post('/comments/{survey_key}','SurveyController@newComments')->name('add-comments');


// Page
Route::get('/404','PagesController@page404')->name('page-404');
Route::get('/finish/{key}','PagesController@pageSurveyFinish')->name('page-finish');
Route::get('/404','PagesController@pageSurveyAnswered')->name('page-answered');




// Admin
Route::get('/admin/prepare/{blueprint_id}','SurveyAdminController@prepare')->name('email-prepare');
Route::get('/admin/send/{survey_key}','SurveyAdminController@send')->name('email-send');
Route::get('/admin/contributors/{survey_key}','SurveyAdminController@contributors')->name('contributors');


//Route::group(['middleware' => 'auth'], function () {

    Route::group(['prefix' => 'admin'], function() {

        // Blueprints
        Route::resource(
            'blueprints',
            'BlueprintController' ,
            array(
                'names' => array(
                    'index' => 'blueprint-index'
                )
            )
        );

        // Surveys
        Route::get('surveys/{blueprint_id}','SurveyController@index')->name('list-survey');
        Route::get('surveys/destroy/{survey_id}','SurveyController@destroy')->name('destroy-survey');
        Route::post('surveys/{survey_id}','SurveyController@save')->name('save-survey');

    });

//});