<div  class="modal fade" id="add-user-modal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-left font-weight-bold">Nouveau participant</h4>
                <button type="button" class="close float-right" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

                <div class="row d-none">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::text( 'firstname' , null , array( 'class' => 'form-control' , 'id' => 'input-firstname' , 'placeholder' => 'Nom du participant') ) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::text( 'lastname' , null , array( 'class' => 'form-control' , 'id' => 'input-lastname' , 'placeholder' => 'Prénom du participant') ) !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="input-group">
                            {!! Form::text( 'email' , null , array( 'class' => 'form-control' , 'id' => 'input-email' , 'placeholder' => 'Email du participant' , 'data-name' => 'email') ) !!}
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">@ca-normandie-seine.fr</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary add-btn" data-type="user" data-link="{{route('add-user')}}" data-id="{{$blueprint->id}}">
                    Enregistrer
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
        </div>

    </div>
</div>