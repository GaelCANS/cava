<div class="row" style="margin-bottom: 20px">
    <div class="col-md-12">
        {!! Form::select( 'room' , $all_rooms , $room , array( 'class' => 'form-control', 'id' => 'select-room' , 'basepath' => route('pilotage' , array('id' => $id)) ) ) !!}
    </div>
</div>

<div id="rooms" style="margin-bottom: 20px"></div>

<div class="row">
    <div class="col-md-12">
        <div id="question-evolution-year" style="margin-bottom: 20px"></div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div id="graph" style="margin-bottom: 20px"></div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div id="months" style="margin-bottom: 20px"></div>
    </div>
    <div class="col-md-6">
        <div id="quarters" style="margin-bottom: 20px"></div>
    </div>
</div>

@foreach($evolutions as $key => $stats)
    <div class="text-hide graph-datas" id="{{$key}}">
        @foreach($stats as $stat)
            <span>
                {{$stat['average'][0]}}
            </span>
        @endforeach
    </div>
@endforeach


<div id="wordings" class="text-hide">
    @foreach($wordings as $wording)
        <span>{{$wording}}</span>
    @endforeach
</div>


<div id="quarters" class="text-hide">
    @foreach($quarters as $i => $quarter)
        <span data-quarter="{{$i}}">{{$quarter}}</span>
    @endforeach
</div>


<div id="months" class="text-hide">
    <span data-month="1">{{$month1}}</span>
    <span data-month="2">{{$month2}}</span>
</div>

@if (count($rooms) > 0 )
<div id="rooms-stats" class="text-hide">
    @foreach($rooms as $room)
        <span class="room-stat" data-name="{{$room->room}}">{{$room->combien}}</span>
    @endforeach
</div>
@endif

@if (count($evolution1year) > 0 )
<div id="year-stat" class="text-hide">
    @foreach($evolution1year as $questions_year_id => $questions_year)
        <div class="year-question" data-id="{{$questions_year_id}}">
            @foreach($questions_year as $question_year)
                <span class="year-answer question-{{$questions_year_id}}" data-period="{{$question_year->periode}}">
                    {{$question_year->note}}
                </span>
            @endforeach
        </div>
    @endforeach
</div>
@endif