<div id="graph" style="margin-bottom: 20px"></div>

<div id="months" style="margin-bottom: 20px"></div>

<div id="quarters" style="margin-bottom: 20px"></div>


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