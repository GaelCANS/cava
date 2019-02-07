@extends('mails.layout')

@section('content')

    <table cellpadding="32" cellspacing="0" border="0" align="center" style="border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: white; border-radius: 0.5rem; margin-bottom: 1rem;">
        <tr><td width="546" valign="top" style="border-collapse: collapse;">
                <div style="max-width: 600px; margin: 0 auto;">

                    <div style="background: white; border-radius: 0.5rem; margin-bottom: 1rem;">
                        <h3 style="color: #00999e;font-size:20px;text-align: center; text-transform: uppercase; line-height: 30px; margin-bottom: 12px; margin: 0 0 12px;">Vous venez d'être habilité à la plateforme Satisfaction Collaborateur</h3>
                        <p>
                            Vous pouvez vous connecter sur la plateforme à l'adresse suivante : <a href="{{ env('APP_URL') }}">{{ env('APP_URL') }}</a>
                        </p>
                        <p>
                            Vos identifiants sont les suivants :
                            <ul>
                                <li>Login : {{$user->email}}</li>
                                <li>Mot de passe : {{$pass}}</li>
                            </ul>
                        </p>
                        <p>
                            Vous pouvez changer votre mot de passe à tout moment en vous rendant dans votre profil utilisateur.
                        </p>
                    </div>

                </div>
            </td>
        </tr></table>

@endsection