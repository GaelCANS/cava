
<table class="table">
@forelse($blueprint->Users as $user)
    <tr>
        <th scope="row">{{$user->firstname}} {{$user->lastname}}</th>
        <td>{{$user->email}}</td>
        <td>{{ route('show-survey-front' , \App\Survey::createKey( array($survey->key , $user->key , $question->key) )) }}</td>
    </tr>
    @empty
@endforelse
</table>