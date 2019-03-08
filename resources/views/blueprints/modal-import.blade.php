<div  class="modal fade" id="import-modal" role="dialog">
    <div class="modal-dialog">

        {!! Form::model(
            null,
            array(
                'class'     => 'form-horizontal dropzone',
                'url'       => action('UserController@import' , null),
                'method'    => 'Post',
                'id'        => 'coucou',
                'files'     => true
            )
        ) !!}

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Import d'utilisateurs <span class="data-survey"></span></h4>
            </div>
            <div class="modal-body">

                    {!! Form::file('file') !!}

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