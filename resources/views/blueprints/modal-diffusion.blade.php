<div  class="modal fade" id="diffusion-modal" role="dialog">
    <div class="modal-dialog">

        {!! Form::model(
            null,
            array(
                'class'     => 'form-horizontal',
                'url'       => action('UserController@liste' , null),
                'method'    => 'Post',
                'id'        => 'form-liste'
            )
        ) !!}

                <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Import d'utilisateurs depuis Outlook <span class="data-survey"></span></h4>
            </div>
            <div class="modal-body">

                {!! Form::text( 'listes' , null , array( 'class' => 'form-control', 'placeholder' => "Ex: MASSE Axel <Axel.MASSE@ca-normandie-seine.fr>; D HUBERT Astrid <astrid.dhubert@ca-normandie-seine.fr>; BERT Stephane <Stephane.BERT@ca-normandie-seine.fr>; LEVANT Gael <Gael.LEVANT@ca-normandie-seine.fr>" ) ) !!}

                {!! Form::hidden('blueprint' , $blueprint->id) !!}

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-success" >Importer</button>
            </div>
        </div>

        {!! Form::close() !!}

    </div>
</div>