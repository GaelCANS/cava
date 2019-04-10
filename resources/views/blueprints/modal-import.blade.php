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
                <h4 class="modal-title font-weight-bold">Import d'utilisateurs <span class="data-survey"></span></h4>
                <button type="button" class="close float-right" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

                    {!! Form::file('file') !!}

                    {!! Form::hidden('blueprint' , $blueprint->id) !!}

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" >Importer</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
        </div>

        {!! Form::close() !!}

    </div>
</div>