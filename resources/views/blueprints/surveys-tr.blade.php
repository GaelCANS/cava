<tr>
    <td>
        {!! Form::text( 'begin['.$survey->id.']' , $survey->beginlong , array( 'class' => 'form-control datepicker ajax-date' , 'data-id' => $survey->id , 'data-period' => 'begin' , 'data-name' => 'begin') ) !!}
    </td>
    <td>
        {!! Form::text( 'end['.$survey->id.']' , $survey->endlong , array( 'class' => 'form-control datepicker ajax-date' , 'data-id' => $survey->id , 'data-period' => 'end' , 'data-name' => 'end') ) !!}
    </td>
    <td>{{$survey->guests}}/{{$blueprint->guests}}</td>
    <td>{{(int) $survey->sended}}</td>
    <td>
        <a href="{{action("SurveyController@destroy" , $survey)}}" class="del-btn" title="Supprimer" data-confirm="Voulez-vous vraiment supprimer" data-method="delete"><button type="button" class="btn btn-outline-secondary icon-btn"><i class="mdi mdi-delete"></i></button></a>
    </td>
</tr>