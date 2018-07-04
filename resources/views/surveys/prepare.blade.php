@extends('backoff.app')

@section('content')

    <div id="intro">
        <h1>{{$blueprint->name}}</h1>
        <h2>{{$blueprint->intro}}</h2>
        Période : {{$blueprint->begin}} / {{$blueprint->end}}<br>
        Gestionnaires : {{$blueprint->emails}}<br>
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
                    <a href="{{route('comments' , array($survey->key))}}" target="_blank">voir les résultats</a>
                    <a class="invitation" href="{{route('email-send', array($survey->key))}}">envoyer les invitations</a>
                    <a class="contributors" style="cursor: pointer" data-toggle="modal" data-target="#users" data-key="{{$survey->key}}" data-href="{{route('contributors', array($survey->key))}}">liste des participants</a>
                </td>
            </tr>
            @empty
            <th colspan="5">Aucune enquête</th>
        @endforelse
        </tbody>
    </table>


    <div class="modal" tabindex="-1" role="dialog" id="users">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Utilisateurs</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>


@endsection