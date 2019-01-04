<?php

namespace App\Http\Controllers;

use App\Blueprint;
use App\Question;
use App\Survey;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($blueprint_id)
    {
        $blueprint = Blueprint::findOrFail($blueprint_id);
        $users = User::whereBlueprintId($blueprint_id)->orderBy('id')->get();
        $tab = "guests";
        return view('blueprints.show' , compact( 'blueprint' , 'users' , 'tab'));
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
        $user = User::create(array_merge($request->all(), array('key'=>uniqid())));
        $html = view('blueprints.guests-tr' , compact('user' ))->render();

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
        $user = User::findOrFail($request->get('id'));
        $datas = array();
        $datas[$request->get('name')] = $request->get('value');

        $user->update($datas);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->answers == 0) {
            $user->delete();
            return redirect()->back()->with('success', "L'utilisateur vient d'être supprimé");
        }
        return redirect()->back()->with('error', "Impossible de supprimer cet utilisateur.");
    }

    public function test($survey_key)
    {
        return redirect()->route('SPE-LN-register',$survey_key)->with('success-fade','Vos réponses ont bien été enregistrées. Merci de votre participation.');
    }

    public function SPEregister($survey_key)
    {
        $survey = Survey::findOrFail( Survey::getId($survey_key) );
        $blueprint = Blueprint::findOrFail($survey->blueprint_id);

        return view('users.register', compact('survey' , 'blueprint'));
    }

    public function SPEstore(Request $request, $survey_key)
    {
        $survey = Survey::findOrFail( Survey::getId($survey_key) );
        $question = Question::where('blueprint_id' , $survey->blueprint_id)->orderBy('order','ASC')->first();

        $user = User::create(array_merge($request->all() , array('blueprint_id' => $survey->blueprint_id, 'key' => uniqid())));


        return redirect()->route('show-survey-front' , array( Survey::createKey( array($survey->key, $user->key , $question->key) ) ));
    }
}
