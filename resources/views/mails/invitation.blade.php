@extends('mails.layout')

@section('content')

    <table cellpadding="32" cellspacing="0" border="0" align="center" style="border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: white; border-radius: 0.5rem; margin-bottom: 1rem;">
        <tr>
            <td width="546" valign="top" style="border-collapse: collapse;text-align: left">
                <div style="max-width: 600px; margin: 0 auto;text-align: left">

                    <div style="background: white;text-align: left; border-radius: 0.5rem; margin-bottom: 1rem;" align="">

                        Nom du sondage : {{$blueprint->name}}
                        <br>
                        Texte introductif : {{$blueprint->intro}}
                        <br>
                        Date de début de réponse au questionnaire : {{$survey->beginshort}}
                        <br>
                        Date de fin de réponse au questionnaire : {{$survey->beginshort}}
                        <br>
                        Nom du contact : {{$user->firstname}}
                        {{$user->lastname}}
                        <br>

                        Lien vers le questionnaire : {{$link}}

                    </div>

                </div>
            </td>
        </tr>
    </table>

@endsection