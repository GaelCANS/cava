<?php

namespace App\Http\Controllers;

use App\Blueprint;
use Illuminate\Http\Request;

use App\Http\Requests;

class BlueprintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blueprints = Blueprint::whereDeleted('0')->get();
        $blueprints->load('User');
        return view('blueprints.index' , compact('blueprints'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $blueprint =  null;
        $tab = "blueprint";
        return view('blueprints.show' , compact('blueprint','tab'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\BlueprintRequest $request)
    {
        $blueprint = Blueprint::create( array_merge($request->all() , array('note_min' => 0, 'note_max' => 5, 'user_id' => 1) ) );
        return redirect(action('BlueprintController@show' , $blueprint))->with('success' , "Le sondage a bien été crée.");
    }
    
    
    public function newBlueprint()
    {
        $blueprint = Blueprint::create( array('note_min' => 0, 'note_max' => 5, 'user_id' => 1) );
        return redirect(action('BlueprintController@show' , $blueprint))->with('success' , "Le sondage a bien été crée.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blueprint = Blueprint::findOrFail($id);
        $tab = "blueprint";
        return view('blueprints.show' , compact('blueprint','tab'));
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
    public function update(Requests\CommonRequest $request, $id)
    {
        $blueprint = Blueprint::findOrFail($id);
        $datas = array();
        $datas[$request->get('name')] = $request->get('value');

        $blueprint->update($datas);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blueprint = Blueprint::findOrFail($id);
        $blueprint->deleted = true;
        $blueprint->save();
        return redirect(action('BlueprintController@index'))->with('success' , "Le questionnaure a bien été supprimé.");
    }
    
}
