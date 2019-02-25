<?php

namespace App\Http\Controllers;

use App\Blueprint;
use App\Question;
use App\Survey;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('SuperAdmin' , array('only' => array('admin_index' , 'store_admin', 'delete')) );
    }

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


    public function admin_index()
    {
        $users = User::whereAdmin('1')->get();
        return view('users.index' , compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store_admin(Requests\CreateAdminRequest $request)
    {
        $pass = substr(uniqid(),0,7);
        $data = array_merge($request->all() , array('password' => Hash::make($pass) , 'admin' => '1'));
        $user = User::create($data);

        Mail::send('mails.admin', compact('user', 'pass'), function ($m) use ($user) {
            $m->from('nepasrepondre@ca-normandie-seine.fr', 'Crédit Agricole Normandie-Seine');
            $m->to($user->email)->subject("[Satisfaction collaborateur] création d'un profil administrateur.");
        });

        return redirect()->action('UserController@admin_index')->with('success', "Ajout de l'utilisateur effectué. Un email vient d'être envoyé.");
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
        $user = (int)$id > 0 ? User::findOrFail($id) : null;
        return view('users.show' , compact('user'));
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


    public function update_admin(Requests\UpdateAdminRequest $request, $id)
    {
        $user = User::findOrFail($id);
        if ($id != auth()->user()->id) {
            $user->update($request->all());
        }
        else {
            $data = array_merge($request->except('password_confirmation') , array('password' => Hash::make($request->get('password')) ));
            $user->update($data);
        }
        return redirect()->back()->with('success', "Mise à jour effectuée.");
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

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->update( array('admin' => 0) );
        return redirect()->back()->with('success', "L'utilisateur vient d'être supprimé");
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


        return redirect()->route('SPE-LN-room' , array( Survey::createKey( array($survey->key, $user->key , $question->key) ) ));
        //return redirect()->route('show-survey-front' , array( Survey::createKey( array($survey->key, $user->key , $question->key) ) ));
    }


    public function SPEroom($key)
    {
        // Explode keys to get survey's key - user's key - question's key
        $keys = Survey::explodeKeys($key);

        return view('users.meetingroom', compact('key'));

    }


    public function SPEstoreroom(Request $request, $key)
    {
        // Explode keys to get survey's key - user's key - question's key
        $keys = Survey::explodeKeys($key);
        $user = User::whereKey($keys['user'])->first();
        $user->update($request->all());

        return redirect()->route('show-survey-front' , $key);

    }
}
