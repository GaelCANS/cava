@extends('frontoff.app')

@section('content')
    <div class="row">
        <div class="col-md-8 text-center mx-auto px-4 mb-5">
            <div class="row>"><h3>{{$survey->Blueprint->name}}</h3></div>
            Notes moyennes sur le période actuelle
            Note moyenne toutes périodes
        </div>
    </div>

    @foreach($averages as $average)
        @include('questions.average')
    @endforeach

    @include('questions.modal')


@endsection