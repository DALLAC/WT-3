<h1>Пользователи</h1>

<ul>
@foreach($users as $user)
    <li>
        {{ $user->username }} ({{ $user->email }})

        <a href="{{ route('users.studios.byId', $user->id) }}">
            студии по ID
        </a>

        <a href="{{ route('users.studios.byUsername', $user) }}">
            студии по username
        </a>

        @auth
            @if(auth()->id() !== $user->id)
                @if(in_array($user->id, $friendIds ?? [], true))
                    <form method="POST" action="{{ route('users.friends.destroy', $user->id) }}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Удалить из друзей</button>
                    </form>
                @else
                    <form method="POST" action="{{ route('users.friends.store', $user->id) }}" style="display:inline;">
                        @csrf
                        <button type="submit">Добавить в друзья</button>
                    </form>
                @endif
            @endif
        @endauth
    </li>
@endforeach
</ul>