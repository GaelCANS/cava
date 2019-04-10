@extends('backoff.app')

@section('content')



    <h4 class="page-title d-inline-block mr-2 mb-4">
        @if( $user == null ) Création d'un utilisateur @else Mise à jour utilisateur @endif
    </h4>


    @if ($user != null && $user->superadmin == 1)
        <div class="float-right">
            <a href="{{route('list-admins')}}" class="btn btn-info"><i class="fa fa-angle-left"></i> Retour</a>
        </div>
    @endif


    {!! Form::model(
        $user,
        array(
            'class'     => 'form-horizontal',
            'url'       => action('UserController@'.($user == null ? 'store_admin' : 'update_admin') , $user),
            'method'    => $user == null ? 'Post' : 'Put'
        )
    ) !!}
<div class="card col-12 col-lg-8 p-4 bg-light">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <h6>Nom</h6>
                {!! Form::text( 'firstname' , null , array( 'class' => 'form-control' , 'placeholder' => "Saisissez votre nom" ) ) !!}
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <h6>Prénom</h6>
                {!! Form::text( 'lastname' , null , array( 'class' => 'form-control' , 'placeholder' => "Saisissez votre prénom" ) ) !!}
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-md-6">
            <div class="form-group">
                <h6>Email</h6>
                {!! Form::email( 'email' , null , array( 'class' => 'form-control' , 'placeholder' => "Saisissez votre email"  ) ) !!}
            </div>
        </div>

    </div>

    @if ($user != null && auth()->user()->id == $user->id)
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <h6>Nouveau mot de passe</h6>
                    {!! Form::password( 'password' , array( 'class' => 'form-control') ) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <h6>Confirmer le nouveau mot de passe</h6>
                    {!! Form::password( 'password_confirmation'  , array( 'class' => 'form-control' ) ) !!}
                </div>
            </div>
        </div>
    @endif


    <div class="row">
        <div class="form-group">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-fw fa-save"></i>Enregister
                </button>
            </div>
        </div>
    </div>
</div>

    {!! Form::close() !!}

    </div>

@endsection