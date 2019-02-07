@extends('backoff.app')

@section('content')

    <h4 class="page-title d-none">Questionnaires</h4>
    <a href="{{route('new-blueprint')}}"><button type="button" class="btn btn-secondary btn-xs mb-2" title="Ajouter">+ Ajouter un questionnaire</button></a>

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <input class="form-control" id="myInput" type="text" placeholder="Filtre de recherche..">
                                <table class="table table-hover ajax-action" id="blueprints">
                                    <thead>
                                    <tr>
                                        <th width="45%">Nom</th>
                                        <th>Questions</th>
                                        <th>Itérations</th>
                                        <th>Période</th>
                                        <th>Responsable</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($blueprints as $blueprint)
                                        <tr>
                                            <th class="text-left">{{$blueprint->name}}</th>
                                            <th>
                                                <a href="{{route('list-question' , $blueprint)}}">
                                                    {{$blueprint->countQuestion}}
                                                </a>
                                            </th>
                                            <th>
                                                <a href="{{route('list-survey' , $blueprint)}}">
                                                    {{$blueprint->sendedSurvey}}/{{$blueprint->countSurvey}}
                                                </a>
                                            </th>
                                            <th>{{$blueprint->period}}</th>
                                            <th>{{$blueprint->user->fullname}}</th>
                                            <th>
                                                <a href="{{action("BlueprintController@show" , $blueprint)}}" title="Modifier"><button type="button" class="btn btn-outline-secondary icon-btn"><i class="mdi mdi-border-color"></i></button></a>
                                                @if (!$blueprint->SpeLN &&  $blueprint->user_id == auth()->user()->id)
                                                    <a href="{{action("BlueprintController@destroy" , $blueprint)}}"  title="Supprimer" data-confirm="Voulez-vous vraiment supprimer" data-method="delete"><button type="button" class="btn btn-outline-secondary icon-btn"><i class="mdi mdi-delete"></i></button></a>
                                                @else
                                                    <button type="button" class="btn btn-outline-secondary icon-btn disabled" style="cursor: not-allowed"><i class="mdi mdi-delete"></i></button>
                                                @endif
                                            </th>
                                        </tr>
                                    @empty
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
