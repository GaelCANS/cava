@extends('frontoff.app')

@section('content')

    <div class="row">

        <div class="col-md-12 text-center">

            Vous avez déjà répondu à ce formulaire.
            <br>
            <a href="{{ route('results-survey-front' , array($survey_key, $user_key)) }}">Voir les résultats</a>

        </div>

    </div>

@endsection