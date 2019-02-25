@extends('frontoff.app')

@section('content')

    <div class="row">
        <div class="col-md-8 text-center mx-auto px-4">

            {!! Form::model(
                null,
                array(
                    'class'     => 'form-horizontal',
                    'url'       => route('SPE-LN-storeroom', $key),
                    'method'    => 'Post',
                    'id'        => 'SPE-room-form'
                )
            ) !!}

            <div class="row" style="margin-bottom: 20px;">
                <div class="col-12">
                    Quelle salle de réunion avez-vous utilisé ?
                </div>
            </div>

            <div class="row" id="meeting-room">
                <div class="col-sm">
                    <div class="title-room">Espace Showroom</div>
                    <div class="room room-1" data-value="espace-showroom">
                        &nbsp;
                    </div>
                </div>
                <div class="col-sm">
                    <div class="title-room">Espace Co-création</div>
                    <div class="room room-2" data-value="espace-co-creation">
                        &nbsp;
                    </div>
                </div>
                <div class="col-sm">
                    <div class="title-room">Espace projets Agiles</div>
                    <div class="room room-3" data-value="espace-projets-agiles">
                        &nbsp;
                    </div>
                </div>
            </div>

            {!! Form::hidden('room', null , array( 'id' => 'SPE-room')  ) !!}

            {!! Form::close() !!}

        </div>
    </div>




@endsection