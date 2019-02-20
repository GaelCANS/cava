@extends('frontoff.app')

@section('content')

    <div class="row">
        <div class="col-md-8 text-center mx-auto px-4">

    {!! Form::model(
        null,
        array(
            'class'     => 'form-horizontal',
            'url'       => route('SPE-LN-store', $survey->key),
            'method'    => 'Post',
            'id'        => 'SPE-user-form'
        )
    ) !!}

    <div class="input-group mb-3">
        {!! Form::text('email', null , array( 'class' => 'form-control', 'placeholder' => 'Votre email', 'id' => 'SPE-email')  ) !!}
        <div class="input-group-append">
            <span class="input-group-text" id="basic-addon2">@ca-normandie-seine.fr</span>
        </div>
    </div>

    {!! Form::hidden('firstname', null , array( 'id' => 'SPE-firstname')  ) !!}
    {!! Form::hidden('lastname', null , array( 'id' => 'SPE-lastname')  ) !!}

    <button type="submit" class="active" style="margin-top: 20px">Valider</button>

    {!! Form::close() !!}

        </div>
    </div>




@endsection