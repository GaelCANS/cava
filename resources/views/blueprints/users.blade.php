<div class="table-responsive">
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Nom prénom</th>
            <th>Email</th>
            <th>Participation</th>
        </tr>
        </thead>
        <tbody>
        @forelse($users as $user)
            <tr>
                <td>
                    {{$user->fullname}}
                </td>
                <td>
                    {{$user->email}}
                </td>
                <td>
                    {{$user->participate($survey->id)}}
                </td>
            </tr>
            @empty
        @endforelse
        </tbody>
    </table>
</div>