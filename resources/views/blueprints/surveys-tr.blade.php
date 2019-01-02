<tr data-id="{{$survey->id}}" data-link="{{route('participants-survey' , $survey->id)}}" class="@if ($survey->current) active @endif">
    <td class="text-right">
        @if ($survey->current)
            <i class="mdi mdi-forward"></i>
        @endif
    </td>
    <td>
        {!! Form::text( 'begin['.$survey->id.']' , $survey->beginlong , array( 'class' => 'form-control datepicker ajax-date' , 'data-id' => $survey->id , 'data-period' => 'begin' , 'data-name' => 'begin') ) !!}
    </td>
    <td>
        {!! Form::text( 'end['.$survey->id.']' , $survey->endlong , array( 'class' => 'form-control datepicker ajax-date' , 'data-id' => $survey->id , 'data-period' => 'end' , 'data-name' => 'end') ) !!}
    </td>
    <td class="show-users">{{$survey->guests}}/{{$blueprint->guests}}</td>
    <td>{{$survey->sended_at}}</td>
    <td>
        <a href="{{route('comments-survey' , array($survey->id))}}" class="open-comments" title="Voir les commentaires de l'itération"><button type="button" class="btn btn-outline-secondary icon-btn"><i class="mdi mdi-comment"></i></button></a>
        <a href="{{route('comments' , array($survey->key))}}" class="" target="_blank" title="Voir les résultats l'itération"><button type="button" class="btn btn-outline-secondary icon-btn"><i class="mdi mdi-chart-bar"></i></button></a>
        <a href="{{route("send-survey" , $survey)}}" class="send-btn confirm" title="Envoyer l'itération" data-confirm="Voulez-vous vraiment envoyer cette itération ?"><button type="button" class="btn btn-outline-secondary icon-btn"><i class="mdi mdi-send"></i></button></a>
        <a href="{{action("SurveyController@destroy" , $survey)}}" class="del-btn" title="Supprimer" data-confirm="Voulez-vous vraiment supprimer" data-method="delete"><button type="button" class="btn btn-outline-secondary icon-btn"><i class="mdi mdi-delete"></i></button></a>
    </td>
</tr>