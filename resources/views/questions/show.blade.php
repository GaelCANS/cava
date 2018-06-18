@extends('frontoff.app')

@section('content')

    <div class="row">
        <div id="question-box" class="col-md-8 text-center mx-auto">

            <h3>{{$survey->Blueprint->  name}}</h3>

            <h2>{{$question->wording}}</h2>


            <div class="emote">
                <img src="{{ asset('/img/smiley/3.png') }}"/>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 text-center mx-auto px-4">

            {!! Form::model(
                null,
                array(
                    'class'     => 'form-horizontal',
                    'url'       => route('answer-survey-front', $key),
                    'method'    => 'Post'
                )
            ) !!}




        @if ($question->type == 'close')
                <div class="row justify-content-between col-md-8 mx-auto">
                    <p class="col-3 range-text p-0 text-left text-muted">Pas du tout</p>
                    <p class="col-3 p-0 text-right text-muted">Totalement</p>
                    <input type="range" min="0" max="5" step="1" name="result" value="{{ rand(0,5) }}"  >
                    <datalist>
                        <option value="0" style="background: transparent;">
                        <option value="1">
                        <option value="2">
                        <option value="3">
                        <option value="4">
                        <option value="5"style="background: transparent;">
                    </datalist>
                </div>

                @else
                <textarea name="result" id="" placeholder="Écrivez ici votre commentaire"></textarea>
            @endif


            <div class="dot-progress">
                <a href="#"><i class="fa fa-circle check"></i></a>
                <a href="#"><i class="fa fa-circle check"></i></a>
                <a href="#"><i class="fa fa-circle check"></i></a>
                <a href="#"><i class="fa fa-circle active"></i></a>
                <a href="#"><i class="fa fa-circle"></i></a>
                <a href="#"><i class="fa fa-circle"></i></a>
                <a href="#"><i class="fa fa-circle"></i></a>
                <a href="#"><i class="fa fa-circle"></i></a>
            </div>
            <div class="order text-muted">- {{$question->order}}/{{count($survey->Blueprint->Questions)}} -</div>



        </div>
    </div>

    <button class="nav previous @if($previous != false) enabled @else disabled @endif">
        <a href="@if($previous != false) {{ route('show-survey-front' , $previous) }} @else # @endif">
            <i class="fa fa-angle-left"></i>
        </a>
    </button>

    <button type="submit" class="nav next"><i class="fa fa-angle-right"></i></button>

    {!! Form::close() !!}



@endsection