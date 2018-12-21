{!! Form::model(
        null,
        array(
            'class'     => 'form-horizontal',
            'url'       => action('QuestionController@update' , null),
            'method'    => 'Post',
            'id'        => 'question-form',
            'refresh'   => action('QuestionController@refresh')
        )
    ) !!}

<ul id="container-questions" class="table sortable">
    @forelse($questions as $question)
        @include('blueprints.questions-tr')
    @empty
    @endforelse
</ul>

<button type="button" class="btn btn-primary add-btn" data-type="question" data-link="{{route('add-question')}}" data-id="{{$blueprint->id}}">
    <i class="fa fa-fw fa-plus"></i>Ajouter une question
</button>

{!! Form::close() !!}