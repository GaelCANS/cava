@extends('mails.layout')

@section('content')

    <table cellpadding="32" cellspacing="0" border="0" align="center" style="border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: white; border-radius: 0.5rem; margin-bottom: 1rem;">
        <tr><td width="546" valign="top" style="border-collapse: collapse;">
                <div style="max-width: 600px; margin: 0 auto;">

                    <div style="background: white; border-radius: 0.5rem; margin-bottom: 1rem;">
                        <h3 style="color: #00999e;font-size:20px;text-align: center; text-transform: uppercase; line-height: 30px; margin-bottom: 12px; margin: 0 0 12px;">{!! $blueprint->name !!}</h3>
                        <p style="font-size: 17px; line-height: 24px;text-align: left; margin: 0 0 16px;">{!! str_replace( array('%%--link_survey--%%' , '%%--days--%%' , '%%--link_results--%%', '%%--begin--%%', '%%--end--%%') , array("<a href='$link'>$link</a>" , $survey->duree , "<a href='$result'>$result</a>", $survey->beginlong, $survey->endlong) , nl2br($blueprint->intro)) !!}</p>

                    </div>

                </div>
            </td>
        </tr></table>

@endsection