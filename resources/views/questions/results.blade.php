@extends('frontoff.app')

@section('content')
    <div class="row">
        <div class="col-md-8 text-center mx-auto px-4 mb-5">
            <div class="row>"><h3 class="mb-4">{{$survey->Blueprint->name}}</h3></div>
            <span class="text-muted mr-5 d-inline-block"><i class="fas fa-window-minimize" style="font-size: 38px;padding-right: 10px;float: left;margin-top: -17px;color:#58bac0;"></i>Moyenne du {{$survey->beginshort}} au {{$survey->endshort}}</span>
            <span class="text-muted d-inline-block"><i class="fas fa-window-minimize" style="font-size: 38px;padding-right: 10px;float: left;margin-top: -17px;color:#5e5e5e;"></i>Moyennes toutes périodes</span>
        </div>
    </div>

    @if ($type == 'edit')
        {!! Form::model(
            null,
            array(
                'class'     => 'form-horizontal',
                'url'       => route('add-comments' , $survey_key),
                'method'    => 'Post',
                'id'        => 'comment-form'
            )
        ) !!}
    @endif

    @foreach($averages as $inc => $average)
        @include('questions.average')
    @endforeach

    @include('questions.modal')

    @if ($type == 'edit')
        <div class="text-center mb-5">
            <button type="submit" class="btn btn-success btn-lg" value="Envoyer" name="Envoyer">Mettre à jour</button>
        </div>
        {!! Form::close() !!}
    @endif


@endsection