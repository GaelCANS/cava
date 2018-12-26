<?php

namespace App\Http\Controllers;

use App\Blueprint;
use App\Question;
use Illuminate\Http\Request;

use App\Http\Requests;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($blueprint_id)
    {
        $blueprint = Blueprint::findOrFail($blueprint_id);
        $questions = Question::whereBlueprintId($blueprint_id)->orderBy('order')->get();
        $tab = "questions";
        return view('blueprints.show',compact('questions','tab','blueprint'));
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
        $orderQuestion = Question::whereBlueprintId($request->id)->count();
        $question = Question::create( array('blueprint_id' => $request->id , 'key' => uniqid() , 'order' => $orderQuestion+1 , 'type' => 'close' , 'enabled' => '1') );
        $html = view('blueprints.questions-tr' , compact('question' ))->render();

        return response()->json(
            array(
                'html'=> $html,
            )
        );
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
    public function update(Requests\CommonRequest $request)
    {
        $question = Question::findOrFail($request->get('id'));
        $datas = array();
        $datas[$request->get('name')] = $request->get('value');

        $question->update($datas);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $blueprint_id = $question->blueprint_id;
        $question->delete();
        Question::reOrder($blueprint_id);
        return redirect()->back()->with('success' , "La question vient d'être supprimée");
    }

    public function refresh(Request $request)
    {
        $questions_ids = $request->get('ids');
        $i = 1;
        if ($questions_ids) {
            foreach ($questions_ids as $question_id) {
                $question = Question::findOrFail($question_id);
                $question->order = $i;
                $question->save();
                $i++;
            }
        }
    }
}
