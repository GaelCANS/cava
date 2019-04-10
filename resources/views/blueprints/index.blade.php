@extends('backoff.app')

@section('content')

    <h4 class="page-title d-inline-block  mb-3 text-uppercase">
       SATISFACTION COLLABORATEUR - Outil d'enquête interne

    </h4>

    <div class="float-right ">
        <input class="form-control" id="myInput" type="text" placeholder="Rechercher une enquête...">
    </div>

    <div class="row">
        <div class="px-2 pull-right w-100">
        </div>
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">

                                <table class="table table-hover  ajax-action" id="blueprints">
                                    <thead>
                                    <tr>
                                        <th width="40%">Nom</th>
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
                                            <th >{{$blueprint->name}}</th>
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
                                                <a href="{{action("BlueprintController@show" , $blueprint)}}" title="Modifier"><button type="button" class="btn btn-outline-primary icon-btn"><i class="mdi mdi-border-color"></i></button></a>
                                                <a href="{{route("duplicate-blueprint" , $blueprint)}}" onclick="return confirm('Voulez-vous dupliquer cette enquête ?');" title="Dupliquer cette enquête"><button type="button" class="btn btn-outline-primary icon-btn"><i class="mdi mdi-content-duplicate"></i></button></a>
                                                @if (!$blueprint->SpeLN &&  $blueprint->user_id == auth()->user()->id)
                                                    <a href="{{action("BlueprintController@destroy" , $blueprint)}}"  title="Supprimer" data-confirm="Voulez-vous vraiment supprimer" data-method="delete"><button type="button" class="btn btn-outline-danger icon-btn"><i class="mdi mdi-delete"></i></button></a>
                                                @else
                                                    @if ($blueprint->SpeLN)
                                                        <a href="{{route('SPE-LN-register' , array($blueprint->lastSurvey))}}" target="_blank" class="" title="Ouvrir l'enquête"><button type="button" class="btn btn-outline-secondary icon-btn"><i class="mdi mdi-open-in-new"></i></button></a>
                                                    @else
                                                        <button type="button" class="btn btn-outline-danger icon-btn disabled" style="cursor: not-allowed"><i class="mdi mdi-delete"></i></button>
                                                    @endif
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
        <a href="{{route('new-blueprint')}}" class="mx-auto w-100 text-center"><button type="button" class="btn btn-primary mb-2" title="Ajouter"><i class="fas fa-plus-circle"></i>Créer une enquête</button></a>

    </div>



@endsection
