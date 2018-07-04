@extends('backoff.app')

@section('content')

    <div id="intro">
        <h1>{{$blueprint->name}}</h1>
        <h2>{{$blueprint->intro}}</h2>
        Période : {{$blueprint->begin}} / {{$blueprint->end}}<br>
        Gestionnaires : {{$blueprint->emails}}<br>
        <a href="{{route('comments',$first_survey->key)}}" target="_blank">Commentaires</a>
    </div>


    <table class="table">
        <thead class="thead-light">
        <tr>
            <th scope="col">Début</th>
            <th scope="col">Fin</th>
            <th scope="col">Envoyé</th>
            <th scope="col">Nb répondants</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($surveys as $survey)
            <tr>
                <th scope="row">{{$survey->begin}}</th>
                <td>{{$survey->end}}</td>
                <td>{{$survey->sended}}</td>
                <td>{{count($users)}}</td>
                <td>
                    <a href="{{route('results-survey-front' , array($survey->key))}}" target="_blank">voir les résultats</a>
                    <a href="{{route('email-send', array($survey->key))}}">envoyer les invitations</a>
                </td>
            </tr>
            @empty
            <th colspan="5">Aucune enquête</th>
        @endforelse
        </tbody>
    </table>


@endsection