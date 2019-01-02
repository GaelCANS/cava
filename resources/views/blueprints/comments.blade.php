<ul>
    @forelse($comments as $comment)
        <li>
            <div>{{$comment->question->wording}}</div>
            <div>{{$comment->result}}</div>
        </li>
        @empty
        <li>Aucun commentaire pour cet itération</li>
    @endforelse
</ul>