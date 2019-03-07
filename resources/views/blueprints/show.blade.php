@extends('backoff.app')

@section('content')



    <h4 class="page-title d-inline-block mr-2">
        &nbsp;
    </h4>


    <div class="float-right">
        <a href="{{route('blueprint-index')}}" class="btn btn-info"><i class="fa fa-angle-left"></i> Retour</a>
    </div>

    <ul class="nav nav-tabs">
        <li class="nav-item @if($tab == 'blueprint') active @endif"><a class="nav-link @if($tab == 'blueprint') active @endif" href="@if($tab != 'blueprint'){{action("BlueprintController@show" , $blueprint)}}@endif">Sondage</a></li>
        <li class="nav-item @if( $blueprint == null ) disabled @endif @if($tab == 'questions') active @endif"><a class="nav-link @if($tab == 'questions') active @endif"  href="@if( $blueprint == null ){{'#'}}@else{{route('list-question',$blueprint)}}@endif">Questions</a></li>
        <li class="nav-item @if( $blueprint == null ) disabled @endif @if($tab == 'guests') active @endif"><a class="nav-link @if($tab == 'guests') active @endif"  href="@if( $blueprint == null ){{'#'}}@else{{route('list-users' , $blueprint)}}@endif">Utilisateurs</a></li>
        <li class="nav-item @if( $blueprint == null ) disabled @endif @if($tab == 'surveys') active @endif"><a class="nav-link @if($tab == 'surveys') active @endif"  href="@if( $blueprint == null ){{'#'}}@else{{route('list-survey' , $blueprint)}}@endif">Itérations</a></li>
        @if ($blueprint->SpeLN)
        <li class="nav-item @if( $blueprint == null ) disabled @endif @if($tab == 'pilotage') active @endif"><a class="nav-link @if($tab == 'pilotage') active @endif"  href="@if( $blueprint == null ){{'#'}}@else{{route('pilotage' , $blueprint)}}@endif">Statistiques</a></li>
        @endif
    </ul>

    @include('blueprints.'.$tab)


@endsection