@extends('backoff.app')

@section('content')



    <h4 class="page-title d-inline-block mr-2">
        @if( $blueprint == null ) Création  @else Edition @endif d'un sondage
    </h4>


    <div class="float-right">
        <a href="{{route('blueprint-index')}}" class="btn btn-info"><i class="fa fa-angle-left"></i> Retour</a>
    </div>

    <ul class="nav nav-tabs">
        <li class="@if($tab == 'blueprint') active @endif"><a href="#">Sondage</a></li>
        <li class="@if( $blueprint == null ) disabled @endif @if($tab == 'survey') active @endif"><a href="@if( $blueprint == null ){{'#'}}@else{{route('list-survey' , $blueprint)}}@endif">Itération</a></li>
        <li class="@if( $blueprint == null ) disabled @endif @if($tab == 'question') active @endif"><a href="@if( $blueprint == null ){{'#'}}@else{{'#'}}@endif">Questions</a></li>
        <li class="@if( $blueprint == null ) disabled @endif @if($tab == 'dashboard') active @endif"><a href="@if( $blueprint == null ){{'#'}}@else{{'#'}}@endif">Pilotage</a></li>
    </ul>



    @include('blueprints.'.$tab)


@endsection