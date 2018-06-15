@extends('frontoff.app')

@section('content')

    <div class="row">
        <div id="question-box" class="col-md-8 text-center mx-auto">

            <h3>{{$survey->Blueprint->  name}}</h3>

            <h2>{{$question->wording}}</h2>


            <div class="emote">
                <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDQyIDQyIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA0MiA0MjsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTJweCIgaGVpZ2h0PSI1MTJweCI+CjxnPgoJPGNpcmNsZSBzdHlsZT0iZmlsbDojRkJEOTcxOyIgY3g9IjIxIiBjeT0iMjEiIHI9IjIxIi8+Cgk8cGF0aCBzdHlsZT0iZmlsbDojRjBDNDE5OyIgZD0iTTIxLDM2Yy02LjYxNywwLTEyLTUuMzgzLTEyLTEyYzAtMC41NTMsMC40NDgtMSwxLTFzMSwwLjQ0NywxLDFjMCw1LjUxNCw0LjQ4NiwxMCwxMCwxMCAgIHMxMC00LjQ4NiwxMC0xMGMwLTAuNTUzLDAuNDQ4LTEsMS0xczEsMC40NDcsMSwxQzMzLDMwLjYxNywyNy42MTcsMzYsMjEsMzZ6Ii8+Cgk8cGF0aCBzdHlsZT0iZmlsbDojRTY0QzNDOyIgZD0iTTEyLjU0NSwxMC43MDJDMTIuOTgzLDkuNywxMy45ODIsOSwxNS4xNDYsOWMxLjU2NywwLDIuNjk1LDEuMjk0LDIuODM3LDIuODM3ICAgYzAsMCwwLjA3NywwLjM4My0wLjA5MiwxLjA3MmMtMC4yMjksMC45MzktMC43NjksMS43NzMtMS40OTYsMi40MDlsLTMuODUsMy4zMTdMOC43NiwxNS4zMTljLTAuNzI3LTAuNjM2LTEuMjY3LTEuNDcxLTEuNDk2LTIuNDA5ICAgYy0wLjE2OS0wLjY4OS0wLjA5Mi0xLjA3Mi0wLjA5Mi0xLjA3MkM3LjMxNCwxMC4yOTQsOC40NDIsOSwxMC4wMDksOUMxMS4xNzIsOSwxMi4xMDcsOS43LDEyLjU0NSwxMC43MDJ6Ii8+Cgk8cGF0aCBzdHlsZT0iZmlsbDojRTY0QzNDOyIgZD0iTTI5LjM5LDEwLjcwMkMyOS44MjgsOS43LDMwLjgyOCw5LDMxLjk5MSw5YzEuNTY3LDAsMi42OTUsMS4yOTQsMi44MzcsMi44MzcgICBjMCwwLDAuMDc3LDAuMzgzLTAuMDkyLDEuMDcyYy0wLjIyOSwwLjkzOS0wLjc2OSwxLjc3My0xLjQ5NiwyLjQwOWwtMy44NSwzLjMxN2wtMy43ODUtMy4zMTcgICBjLTAuNzI3LTAuNjM2LTEuMjY3LTEuNDcxLTEuNDk2LTIuNDA5Yy0wLjE2OS0wLjY4OS0wLjA5Mi0xLjA3Mi0wLjA5Mi0xLjA3MkMyNC4xNTksMTAuMjk0LDI1LjI4OCw5LDI2Ljg1NCw5ICAgQzI4LjAxOCw5LDI4Ljk1Miw5LjcsMjkuMzksMTAuNzAyeiIvPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=" />
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
                    <input type="range" min="0" max="5" step="1" name="result" value="{{ $result }}"  >
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