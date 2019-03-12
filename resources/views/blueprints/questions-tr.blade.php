<li data-id="{{$question->id}}">

    <div class="row">
        <div class="col-md-10">
            <div class="form-group">

                {!! Form::text( 'wording['.$question->id.']' , $question->wording , array( 'class' => 'form-control ajax-text' , 'data-id' => $question->id , 'data-field' => 'wording' , 'data-name' => 'wording') ) !!}
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">

                <a href="{{action("QuestionController@destroy" , $question)}}" class="del-btn " title="Supprimer" data-confirm="Voulez-vous vraiment supprimer" data-method="delete"><button type="button" class="btn btn-outline-danger icon-btn"><i class="mdi mdi-delete"></i></button></a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <div class="radio">
                    <span>Actif : </span>
                    {!! Form::label('enabled-'.$question->id.'-1', 'Oui', ['class' => '']) !!}
                    {!! Form::radio('enabled['.$question->id.']', '1', ($question->enabled == 1 ? true : false) , ['id' => 'enabled-'.$question->id.'-1' , 'class' => 'ajax-radio' , 'data-name' => 'enabled']) !!}

                    {!! Form::label('enabled-'.$question->id.'-0', 'Non', ['class' => '']) !!}
                    {!! Form::radio('enabled['.$question->id.']', '0', ($question->enabled != 1 ? true : false) , ['id' => 'enabled-'.$question->id.'-0' , 'class' => 'ajax-radio' , 'data-name' => 'enabled']) !!}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <div class="radio">
                    <span>Type : </span>
                    {!! Form::label('type-'.$question->id.'-1', 'Fermée', ['class' => '']) !!}
                    {!! Form::radio('type['.$question->id.']', 'close', ($question->type == 'close' ? true : false) , ['id' => 'type-'.$question->id.'-1' , 'class' => 'ajax-radio' , 'data-name' => 'type']) !!}

                    {!! Form::label('type-'.$question->id.'-0', 'Ouverte', ['class' => '']) !!}
                    {!! Form::radio('type['.$question->id.']', 'open', ($question->type  != 'close' ? true : false) , ['id' => 'type-'.$question->id.'-0' , 'class' => 'ajax-radio' , 'data-name' => 'type']) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::textarea( 'comment' , $question->comment , array( 'class' => 'form-control summernote ajax-text' , 'placeholder' => "Rédigez un commentaire", 'rows' => '4' , 'data-name' => 'comment' ) ) !!}
            </div>
        </div>
    </div>
    <hr>

</li>

