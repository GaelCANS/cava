{!! Form::model(
        null,
        array(
            'class'     => 'form-horizontal',
            'url'       => action('SurveyController@save' , null),
            'method'    => 'Post'
        )
    ) !!}

<div class="table-responsive">
    <table class="table table-hover ajax-action">
        <thead>
        <tr>
            <th>Nom</th>
            <th>Période</th>
            <th>Responsable</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($surveys as $survey)
            <tr>
                <th>
                    {!! Form::text( 'begin['.$survey->id.']' , $survey->beginlong , array( 'class' => 'form-control datepicker' , 'data-name' => 'begin') ) !!}
                </th>
                <th>
                    {!! Form::text( 'end['.$survey->id.']' , $survey->endlong , array( 'class' => 'form-control datepicker' , 'data-name' => 'end') ) !!}
                </th>
                <th>{{$survey->sended}}</th>
                <th>
                    <a href="{{action("SurveyController@destroy" , $survey)}}"  title="Supprimer" data-confirm="Voulez-vous vraiment supprimer" data-method="delete"><button type="button" class="btn btn-outline-secondary icon-btn"><i class="mdi mdi-delete"></i></button></a>
                </th>
            </tr>
        @empty
        @endforelse
        </tbody>
        <tfoot>
        <tr>
            <td colspan="4">
                <button type="button" class="btn btn-primary" class="add-btn" data-type="iteration">
                    <i class="fa fa-fw fa-plus"></i>Ajouter une itération
                </button>
            </td>
        </tr>
        </tfoot>
    </table>
</div>

{!! Form::close() !!}