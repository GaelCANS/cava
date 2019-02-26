{!! Form::model(
        $blueprint,
        array(
            'class'     => 'form-horizontal',
            'url'       => action('BlueprintController@'.($blueprint == null ? 'store' : 'update') , $blueprint),
            'method'    => $blueprint == null ? 'Post' : 'Put',
            'id'        => 'blueprint-form'
        )
    ) !!}

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <h6>Nom</h6>
            {!! Form::text( 'name' , null , array( 'class' => 'form-control ajax-survey' , 'placeholder' => "Le libellé de votre sondage" , 'data-name' => 'name' ) ) !!}
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <h6>Introduction</h6>
            {!! Form::textarea( 'intro' , null , array( 'class' => 'form-control summernote ajax-survey' , 'placeholder' => "Rédigez le texte introductif de votre sondage", 'rows' => '20', 'data-name' => 'intro' , 'id' => 'intro' ) ) !!}
            <div class="dynamics-data">
                <span class="btn btn-success cartouche" data-name="survey">
                    Lien vers l'enquête
                </span>
                <span class="btn btn-success cartouche" data-name="results">
                    Lien vers les résultats
                </span>
                <span class="btn btn-success cartouche" data-name="duree">
                    Durée de l'enquête
                </span>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <h6>Gestionnaires <small>(Séparer les emails par un ;)</small></h6>
            {!! Form::text( 'emails' , null , array( 'class' => 'form-control ajax-survey' , 'placeholder' => "Les gestionnaires de ce sondage", 'data-name' => 'emails' ) ) !!}
        </div>
    </div>
</div>

{!! Form::close() !!}