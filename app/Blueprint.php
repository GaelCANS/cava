<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Blueprint extends Model
{

    protected $guarded = array('id');


    public function getGuestsAttribute()
    {
        return User::whereBlueprintId($this->id)->count();
    }

    public static function setBeginEnd($id)
    {
        $begin  = Survey::where('blueprint_id',$id)->min('begin');
        $end    = Survey::where('blueprint_id',$id)->max('end');
        $blueprint = Blueprint::findOrFail($id);
        $blueprint->begin = $begin;
        $blueprint->end = $end;
        $blueprint->save();
    }

    public function getSpeLNAttribute()
    {
        return $this->id == env('SPE_LN');
    }

    public function getSendedSurveyAttribute()
    {
        return Survey::whereBlueprintId($this->id)->whereSended('1')->count();
    }

    public function getCountSurveyAttribute()
    {
        return Survey::whereBlueprintId($this->id)->count();
    }

    public function getCountQuestionAttribute()
    {
        return Question::whereBlueprintId($this->id)->count();
    }

    public function getLastSurveyAttribute()
    {
        $survey = Survey::whereBlueprintId($this->id)->orderBy('end' , 'DESC')->first();
        return $survey ? $survey->key : null;
    }


    /**
     * RELATIONSHIPS
     */
    public function questions() {
        return $this->hasMany('App\Question');
    }


    public function users() {
        return $this->hasMany('App\User');
    }


    public function surveys() {
        return $this->hasMany('App\Survey');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function getPeriodAttribute()
    {
        if ($this->begin == '0000-00-00' || $this->begin == '' || $this->end == '0000-00-00' || $this->end == '') return '';
        $begin  = Carbon::createFromFormat('Y-m-d', $this->begin)->format('d/m/Y');
        $end    = Carbon::createFromFormat('Y-m-d', $this->end)->format('d/m/Y');
        return $begin.' - '.$end;
    }
}
