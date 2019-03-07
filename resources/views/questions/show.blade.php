@extends('frontoff.app')

@section('content')

    <div class="row">
        <div id="question-box" class="col-md-8 text-center mx-auto">

            <h3>{{($survey->Blueprint->name)}}</h3>

            <h2>{{($question->wording)}}</h2>

            @if ($question->enabled)
            <div class="comment">
                {!! nl2br(utf8_decode($question->comment)) !!}
            </div>
            @endif

            @if ($question->type == 'close')
                @include('questions.emotes')
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 text-center mx-auto px-4">

            {!! Form::model(
                null,
                array(
                    'class'     => 'form-horizontal',
                    'url'       => route('answer-survey-front', $key),
                    'method'    => 'Post',
                    'id'        => 'survey-form'
                )
            ) !!}




            @if ($question->enabled)
                @include('questions.enabled')
            @else
                @include('questions.disabled')
            @endif

            @if ($question->type == 'close' && $question->enabled)
                <button type="button" id="nsp">Ne me prononce pas</button>
            @endif

            @include('questions.navigation')



        </div>
    </div>


    <button type="button" class="nav previous @if($previous != false) enabled @else disabled @endif">
        <a href="@if($previous != false) {{ route('show-survey-front' , $previous) }} @else # @endif">
            <i class="fa fa-angle-left"></i>
        </a>
    </button>



    <button type="submit" class="nav next @if ($question->order == count($survey->Blueprint->Questions) || !$question->enabled) active @endif"><i class="fa fa-angle-right"></i></button>

    {!! Form::close() !!}



@endsection