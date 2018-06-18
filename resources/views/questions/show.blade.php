@extends('frontoff.app')

@section('content')

    <div class="row">
        <div id="question-box" class="col-md-8 text-center mx-auto">

            <h3>{{$survey->Blueprint->  name}}</h3>

            <h2>{{$question->wording}}</h2>

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
                    'method'    => 'Post'
                )
            ) !!}




        @if ($question->type == 'close')
                <div class="row justify-content-between col-md-8 mx-auto">
                    <p class="col-3 range-text p-0 text-left text-muted">Pas du tout</p>
                    <p class="col-3 p-0 text-right text-muted">Totalement</p>
                    <input type="range" min="0" max="5" step="1" name="result" id="result-range" value="{{ $result }}"  >
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
                <textarea name="result" id="result-text" placeholder="Écrivez ici votre commentaire"></textarea>
            @endif


            <div class="dot-progress">
                @forelse($navigations as $navigation)
                    <a @if($navigation['answered'] == 1) href="{{$navigation['link']}}"@endif title="Question {{$navigation['order']}}">
                        <i class="fa fa-circle
                            @if($questionKey != $navigation['key'])
                                @if($navigation['answered'] == 1)
                                    check
                                @endif
                            @else
                                active
                            @endif
                        "></i>
                    </a>
                    @empty
                @endforelse
            </div>
            <div class="order text-muted">- {{$question->order}}/{{count($survey->Blueprint->Questions)}} -</div>



        </div>
    </div>

    <button type="button" class="nav previous @if($previous != false) enabled @else disabled @endif">
        <a href="@if($previous != false) {{ route('show-survey-front' , $previous) }} @else # @endif">
            <i class="fa fa-angle-left"></i>
        </a>
    </button>

    <button type="submit" class="nav next"><i class="fa fa-angle-right"></i></button>

    {!! Form::close() !!}



@endsection