<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Blueprint;
use App\Libraries\Quarter;
use App\Survey;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

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


    public function pilotage($id)
    {
        $blueprint =  Blueprint::findOrFail($id)->load('Surveys')->load('Questions');
        $survey = $blueprint->Surveys->first();
        $tab = "pilotage";

        // Current month
        $now = Carbon::now();
        $period1 = array('begin' => $now->startOfMonth()->format('Y-m-d 00:00:01') , 'end' => $now->lastOfMonth()->format('Y-m-d 23:59:59'));
        $month1 = Answer::participants($survey->id,$period1);

        // Previous month
        $start = new Carbon('first day of last month');
        $end = new Carbon('last day of last month');
        $period2 = array('begin' => $start->format('Y-m-d 00:00:01') , 'end' => $end->lastOfMonth()->format('Y-m-d 23:59:59'));
        $month2 = Answer::participants($survey->id,$period2);

        // Quarters
        $quarters = array();
        for ($i = 1 ;$i <= 4; $i++) {
            $carbon = Quarter::getQuarter($i);
            $period = array('begin'=> $carbon->startOfQuarter($i)->format('Y-m-d 00:00:01') , 'end'=> $carbon->endOfQuarter($i)->format('Y-m-d 23:59:59'));
            $quarters[$i] = Answer::participants($survey->id,$period);
        }

        // Evolution stats
        $day_sub_30 = Carbon::now()->subDays(30)->format('Y-m-d 00:00:01');
        $day_sub_60 = Carbon::now()->subDays(60)->format('Y-m-d 00:00:01');
        $evolutions = array();
        $wordings = array();
        foreach ($blueprint->Questions as $question) {
            if ($question->type == 'open') continue;
            // Stats since begin
            $evolutions['all'][$question->id] = Survey::evolutionQuestion($blueprint->id,'admin',$question->id );
            // Stats between -30 days and now
            $evolutions['m1'][$question->id] = Survey::evolutionQuestion($blueprint->id,'admin',$question->id, array('begin' => $day_sub_30 , 'end' => Carbon::now()->format('Y-m-d 23:59:59')));
            // Stats between -60 days and -30 days
            $evolutions['m2'][$question->id] = Survey::evolutionQuestion($blueprint->id,'admin',$question->id, array('begin' => $day_sub_60 , 'end' => $day_sub_30));

            // Wording
            $wordings[] = $question->wording;
        }



        return view('blueprints.show' , compact('blueprint','tab' , 'month1' , 'month2' , 'quarters' , 'evolutions' , 'wordings'));
    }

    
}
