{!! Form::model(
        null,
        array(
            'class'     => 'form-horizontal',
            'url'       => action('SurveyController@update' , null),
            'method'    => 'Post',
            'id'        => 'survey-form'
        )
    ) !!}

<div class="table-responsive list-table">
    <table class="table table-hover ajax-action">
        <thead>
        <tr>
            <th>&nbsp;</th>
            <th>Début</th>
            <th>Fin</th>
            <th>Participation</th>
            <th>Envoyé le</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($surveys as $survey)
            @include('blueprints.surveys-tr')
        @empty
        @endforelse
        </tbody>
        <tfoot>
        <tr>
            <td colspan="4">
                <button type="button" class="btn btn-primary add-btn" data-type="iteration" data-link="{{route('add-survey')}}" data-id="{{$blueprint->id}}">
                    <i class="fa fa-fw fa-plus"></i>Ajouter une itération
                </button>
            </td>
        </tr>
        </tfoot>
    </table>
</div>

@include('blueprints.modal')
@include('blueprints.modal-comments')

{!! Form::close() !!}