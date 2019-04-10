<tr data-id="{{$survey->id}}" data-link="{{route('participants-survey' , $survey->id)}}" class="@if ($survey->current) active @endif">
    <td class="text-right">
        @if ($survey->current)
            <i class="mdi mdi-forward"></i>
        @endif
    </td>
    <td align="center">
        @if (!$blueprint->SpeLN)
        {!! Form::text( 'begin['.$survey->id.']' , $survey->beginlong , array( 'class' => 'form-control datepicker ajax-date text-center mx-auto' , 'data-id' => $survey->id , 'data-period' => 'begin' , 'data-name' => 'begin') ) !!}
            @else
            {{$survey->beginlong}}
        @endif
    </td>
    <td>
        @if (!$blueprint->SpeLN)
        {!! Form::text( 'end['.$survey->id.']' , $survey->endlong , array( 'class' => 'form-control datepicker ajax-date text-center mx-auto' , 'data-id' => $survey->id , 'data-period' => 'end' , 'data-name' => 'end') ) !!}
            @else
            {{$survey->endlong}}
        @endif
    </td>
    <td class="show-users">{{$survey->guests}}/{{$blueprint->guests}}</td>
    <td>{{$survey->sended_at}}</td>
    <td>
        <a href="{{route('comments-survey' , array($survey->id))}}" class="open-comments" data-from="0" data-range="3" title="Voir les commentaires de l'itération"><button type="button" class="btn btn-outline-primary icon-btn"><i class="mdi mdi-comment"></i></button></a>
        <a href="{{route('comments' , array($survey->key))}}" class="" target="_blank" title="Voir les résultats l'itération"><button type="button" class="btn btn-outline-primary icon-btn"><i class="mdi mdi-chart-bar"></i></button></a>
        @if (!$blueprint->SpeLN)
        <a href="{{route("send-survey" , $survey)}}" class="send-btn confirm" title="Envoyer l'itération" data-confirm="Voulez-vous vraiment envoyer cette itération ?"><button type="button" class="btn btn-outline-primary icon-btn"><i class="mdi mdi-send"></i></button></a>
        <a href="{{action("SurveyController@destroy" , $survey)}}" class="del-btn" title="Supprimer" data-confirm="Voulez-vous vraiment supprimer" data-method="delete"><button type="button" class="btn btn-outline-danger icon-btn"><i class="mdi mdi-delete"></i></button></a>
            @else
            <a href="{{route('SPE-LN-register' , array($survey->key))}}" target="_blank" class="" title="Ouvrir l'enquête"><button type="button" class="btn btn-outline-secondary icon-btn"><i class="mdi mdi-open-in-new"></i></button></a>
        @endif
    </td>
</tr>