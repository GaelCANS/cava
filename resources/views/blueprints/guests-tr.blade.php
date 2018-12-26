<tr data-id="{{$user->id}}" data-link="{{route('update-user' , $user->id)}}">
    <td>
        {!! Form::text( 'firstname['.$user->id.']' , $user->firstname , array( 'class' => 'form-control ajax-user' , 'data-id' => $user->id , 'data-name' => 'firstname') ) !!}
    </td>
    <td>
        {!! Form::text( 'lastname['.$user->id.']' , $user->lastname , array( 'class' => 'form-control ajax-user' , 'data-id' => $user->id , 'data-name' => 'lastname') ) !!}
    </td>
    <td>
        {!! Form::text( 'email['.$user->id.']' , $user->email , array( 'class' => 'form-control ajax-user' , 'data-id' => $user->id , 'data-name' => 'email') ) !!}
    </td>
    <td>

        {{$user->created}}
    </td>
    <td>
        <a href="{{action("UserController@destroy" , $user)}}" class="del-btn" title="Supprimer" data-confirm="Voulez-vous vraiment supprimer" data-method="delete"><button type="button" class="btn btn-outline-secondary icon-btn"><i class="mdi mdi-delete"></i></button></a>
    </td>
</tr>