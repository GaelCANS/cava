@if ($question->type == 'close')
    @include('questions.close')
@else
    @include('questions.open')
@endif