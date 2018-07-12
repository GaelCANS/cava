<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Survey;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Question;
use Illuminate\Support\Facades\URL;

class SurveyController extends Controller
{

    /**
     * SurveyController constructor.
     */
    public function __construct()
    {
        $this->middleware('AllowOnlyAjaxRequests' , array( 'only' => 'evolution' ));
        $this->middleware('SurveyIsOpen' , array( 'only' => 'question' ));
        $this->middleware('SurveyIsAlreadyAnswered' , array( 'only' => 'question' ));
        //$this->middleware('AllowUser' , array( 'only' => 'question' ));
        $this->middleware('AllowResultPage' , array( 'only' => array('results' , 'comments') ));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * Front office show question
     *
     * @param $key
     * @return \Illuminate\Http\Response
     */
    public function question($key)
    {
        // Explode keys to get survey's key - user's key - question's key
        $keys = Survey::explodeKeys($key);

        // Get Survey and load relations
        $survey = Survey::where('key' , $keys['survey'])->first();
        $survey->load('Blueprint');
        $survey->Blueprint->load('Questions');

        // Get Question
        $question = Question::where('key' , $keys['question'])->first();

        // Get Answer if already answered
        $survey_id      = Survey::getId($keys['survey']);
        $user_id        = User::getId($keys['user']);
        $answer         = Answer::where('user_id' , $user_id)
                            ->where('survey_id',$survey_id)
                            ->where('question_id',Question::getId($keys['question']))
                            ->first();
        $result = !is_null($answer) ? $answer->result : -1;

        // Previous button link
        $previous_question = Question::previous($question);
        $previous = $previous_question != false ?
            Survey::createKey( array($keys['survey'] , $keys['user'] , $previous_question) ) :
            false;

        // Navigation links
        $navigations = Question::navigation($survey_id, $user_id);
        $questionKey = $keys['question'];

        return view('questions.show' , compact('survey' , 'question' , 'previous' , 'key' , 'result' , 'navigations' , 'questionKey'));
    }


    /**
     * Front office answer question
     *
     * @param Request $request
     * @param $key
     * @return \Illuminate\Http\Response
     */
    public function answer(Request $request, $key)
    {
        // Explode keys to get survey's key - user's key - question's key
        $keys = Survey::explodeKeys($key);

        // Get Question
        $question = Question::where('key' , $keys['question'])->first();

        // Check if response is already in database
        $user_id        = User::getId($keys['user']);
        $survey_id      = Survey::getId($keys['survey']);
        $question_id    = Question::getId($keys['question']);
        $answer         = Answer::where('user_id' , $user_id)
                            ->where('survey_id',$survey_id)
                            ->where('question_id',$question_id)
                            ->first();
        if (!is_null($answer)) {
            // Update answser in database
            $answer->update( array('result' => $request->input('result')) );
        }
        else {
            // Add answer in database
            $answer = Answer::create(array(
                'user_id'       => $user_id,
                'survey_id'     => $survey_id,
                'question_id'   => $question_id,
                'result'        => $request->input('result')
            ));
        }

        // Next button link
        $next_question = Question::next($question);
        $next = $next_question != false ?
            route('show-survey-front' , Survey::createKey( array($keys['survey'] , $keys['user'] , $next_question) )) :
            route('results-survey-front' , array($keys['survey'] , $keys['user']));

        return redirect($next);
    }


    /**
     * Front office result interface
     *
     * @param $survey_key
     * @param $user_key
     * @return \Illuminate\Http\Response
     */
    public function results($survey_key, $user_key='admin')
    {
        $type = 'show';
        $survey = Survey::findOrFail(Survey::getId($survey_key));
        $survey->load('Blueprint');
        $averages = Survey::results($survey);
        return view('questions.results' , compact('averages' , 'survey' , 'user_key' , 'type'));
    }


    /**
     * Ajax method who returns average et user's note for a question
     *
     * @param $blueprint_id
     * @param $user_key
     * @param $question_key
     * @return mixed
     */
    public function evolution($blueprint_id, $user_key, $question_key)
    {
        $evolutions = Survey::evolutionQuestion($blueprint_id, ($user_key != 'admin' ? User::getId($user_key) : $user_key), Question::getId($question_key));

        return response()->json(
            array(
                'average'   => $evolutions['average'],
                'user'      => $evolutions['user'],
                'key'       => $question_key
            )
        );
    }


    /**
     * Interface to add comments on questions
     *
     * @param $survey_key
     * @return \Illuminate\Http\Response
     */
    public function comments($survey_key)
    {
        $user_key = 'admin';
        $type = 'edit';
        $survey = Survey::findOrFail( Survey::getId($survey_key) );
        $survey->load('Blueprint');
        $averages = Survey::results($survey);

        return view('questions.results' , compact('averages' , 'survey' , 'user_key' , 'type' , 'survey_key'));
    }

    /**
     * Add Or Update comments on questions
     *
     * @param Request $request
     * @return mixed
     */
    public function newComments(Request $request)
    {
        $comments = $request->input('comment');
        foreach ($comments as $question_key => $comment) {
            $question = Question::findOrFail(Question::getId($question_key));
            if ($comment != $question->comment) {
                $question->update(array('comment' => $comment));
            }
        }

        return redirect()->back();
    }
}
