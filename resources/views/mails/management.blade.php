@extends('mails.layout')

@section('content')

    <table cellpadding="32" cellspacing="0" border="0" align="center" style="border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: white; border-radius: 0.5rem; margin-bottom: 1rem;">
        <tr><td width="546" valign="top" style="border-collapse: collapse;">
                <div style="max-width: 600px; margin: 0 auto;">

                    <div style="background: white; border-radius: 0.5rem; margin-bottom: 1rem;">
                        <h3 style="color: #00999e;font-size:20px;text-align: center; text-transform: uppercase; line-height: 30px; margin-bottom: 12px; margin: 0 0 12px;">Une itération vient de se terminer</h3>
                        <p>
                            Vous pouvez dès à présent consulter les résultats de l'enquête {{$blueprint->name}} en vous rendant sur la page suivante
                            <a href="{{$link}}">{{$link}}</a>
                        </p>
                    </div>

                </div>
            </td>
        </tr></table>

@endsection