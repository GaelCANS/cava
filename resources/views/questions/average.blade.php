<div class="row">
    <div id="question-box" class="col-md-6 text-center mx-auto">
        <div class="head-result-box">
            <span class="number float-left">{{$inc+1}}</span>
            <span class="graph float-right open-graph" style="cursor: pointer;" title="Voir l'évolution des résultats pour cette question" data-link="{{ route('evolution' , array($blueprint_id     , $user_key , $average['key'] )) }}">
                <i class="fas fa-chart-area"></i>


            </span>
        </div>
        <div style="clear:both;"></div>
        <div class="col-md-12">
            <h4 class="mt-3 mb-4" id="wording-{{$average['key']}}">{{($average['wording'])}}</h4>
            <div class="barGraph">
                <ul class="graph">
                  <span class="graph-barBack">
                    <li class="graph-bar" data-value="{{$average['survey_avg']}}"></li>
                  </span>
                  <span class="graph-barBack">
                    <li class="graph-bar total" data-value="{{$average['avg']}}"></li>
                  </span>
                </ul>
                <span class="barGraph-check"></span>
                <span class="barGraph-check ml40"></span>
                <span class="barGraph-check ml60"></span>
                <span class="barGraph-check ml80"></span>
            </div>
            @if ($type == 'show')
                @if(trim($average['comment']) != '')
                    <a class="text-muted" data-toggle="collapse" href="#comments-{{$average['order']}}" aria-expanded="false" aria-controls="comments-{{$average['order']}}">Voir les commentaires du gestionnaire</a>

                    <div class="collapse" id="comments-{{$average['order']}}">
                        <div class="card card-body">
                            {!! ($average['comment']) !!}
                        </div>
                    </div>
                @endif
            @else
                <div class="form-group">
                    <textarea name="comment[{{$average['key']}}]" placeholder="Écrivez ici votre commentaire (facultatif)" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Écrivez ici votre commentaire (facultatif)'">{{$average['comment']}}</textarea>
                </div>
            @endif
        </div>
    </div>
</div>