@extends('frontoff.app')

@section('content')

    <div class="row">

        <div class="col-md-12 text-center">

            Vous ne pouvez pas répondre à ce formulaire
            <br>
            @if ($survey->sended == '1')
            <a href="{{ route('results-survey-front' , array($survey_key, $user_key)) }}">Voir les résultats</a>
            @endif

        </div>

    </div>

@endsection