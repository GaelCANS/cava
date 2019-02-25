{!! Form::model(
        null,
        array(
            'class'     => 'form-horizontal',
            'url'       => action('UserController@update' , null),
            'method'    => 'Post',
            'id'        => 'user-form'
        )
    ) !!}

<div class="table-responsive list-table">
    <table class="table table-hover ajax-action">
        <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            @if ($blueprint->SpeLN)
            <th>
                Salle
            </th>
            @endif
            <th>Ajouté le</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @forelse($users as $user)
            @include('blueprints.guests-tr')
        @empty
        @endforelse
        </tbody>
        <tfoot>
        <tr>
            <td colspan="4">
                <button type="button" class="btn btn-primary add-btn" data-type="user-modal">
                    <i class="fa fa-fw fa-plus"></i>Ajouter un utilisateur
                </button>
            </td>
        </tr>
        </tfoot>
    </table>
</div>

@include('blueprints.modal-user')

{!! Form::close() !!}