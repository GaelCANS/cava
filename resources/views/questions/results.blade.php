@extends('frontoff.app')

@section('content')
    <div class="row">
        <div class="col-md-8 text-center mx-auto px-4 mb-5">
            <div class="row>"><h3 class="mb-4">{{$survey->Blueprint->name}}</h3></div>
            <span class="text-muted mr-5 d-inline-block"><i class="fas fa-window-minimize" style="font-size: 38px;padding-right: 10px;float: left;margin-top: -17px;color:#58bac0;"></i> Note moyenne sur le période actuelle</span>
            <span class="text-muted d-inline-block"><i class="fas fa-window-minimize" style="font-size: 38px;padding-right: 10px;float: left;margin-top: -17px;color:#5e5e5e;"></i> Note moyenne toutes périodes</span>
        </div>
    </div>

    @foreach($averages as $average)
        @include('questions.average')
    @endforeach

    @include('questions.modal')


@endsection