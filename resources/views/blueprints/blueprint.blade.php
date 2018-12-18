{!! Form::model(
        $blueprint,
        array(
            'class'     => 'form-horizontal',
            'url'       => action('BlueprintController@'.($blueprint == null ? 'store' : 'update') , $blueprint),
            'method'    => $blueprint == null ? 'Post' : 'Put'
        )
    ) !!}

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <h6>Nom</h6>
            {!! Form::text( 'name' , null , array( 'class' => 'form-control' , 'placeholder' => "Le libellé de votre sondage" ) ) !!}
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <h6>Introduction</h6>
            {!! Form::textarea( 'intro' , null , array( 'class' => 'form-control summernote' , 'placeholder' => "Rédigez le texte introductif de votre sondage", 'rows' => '20' ) ) !!}
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <h6>Gestionnaires <small>(Séparer les emails par un ;)</small></h6>
            {!! Form::text( 'emails' , null , array( 'class' => 'form-control' , 'placeholder' => "Les gestionnaires de ce sondage" ) ) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-fw fa-save"></i>Enregister
            </button>
        </div>
    </div>
</div>

{!! Form::close() !!}