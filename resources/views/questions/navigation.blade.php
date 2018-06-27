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