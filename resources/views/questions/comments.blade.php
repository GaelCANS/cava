@extends('frontoff.app')

@section('content')

    {!! Form::model(
        null,
        array(
            'class'     => 'form-horizontal',
            'url'       => route('add-comments' , $survey_key),
            'method'    => 'Post',
            'id'        => 'comment-form'
        )
    ) !!}

    @forelse($surveyQuestions as $surveyQuestion)
        <div class="form-group">
            <label for="exampleInputEmail1">{{$surveyQuestion->wording}}</label>
            <textarea name="comment[{{$surveyQuestion->key}}]" placeholder="Écrivez ici votre commentaire (facultatif)" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Écrivez ici votre commentaire (facultatif)'">{{$surveyQuestion->comment}}</textarea>
        </div>
        @empty
    @endforelse

    <button type="submit" value="Envoyer" name="Envoyer">Envoyer</button>

    {!! Form::close() !!}


@endsection