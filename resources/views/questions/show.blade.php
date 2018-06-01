@extends('frontoff.app')

@section('content')

    <div class="row">

        <div class="col-md-12 text-center">

            <h1>{{$survey->Blueprint->  name}}</h1>

            <h2>{{$question->wording}}</h2>

            <div class="order">- {{$question->order}}/{{count($survey->Blueprint->Questions)}} -</div>

            <div class="emote">
                :)
            </div>

            {!! Form::model(
                null,
                array(
                    'class'     => 'form-horizontal',
                    'url'       => route('answer-survey-front', $key),
                    'method'    => 'Post'
                )
            ) !!}

            @if ($question->type == 'close')
                <input type="text" name="result" value="{{ rand(0,5) }}" >
                @else
                <textarea name="result" id="" cols="30" rows="10"></textarea>
            @endif



                <button class="nav previous @if($previous != false) enabled @else disabled @endif">
                    <a href="@if($previous != false) {{ route('show-survey-front' , $previous) }} @else # @endif">
                        <
                    </a>
                </button>

            <button type="submit" class="nav next">></button>

            {!! Form::close() !!}

        </div>

    </div>

@endsection