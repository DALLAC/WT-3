<h1>Пользователи</h1>

<ul>
@foreach($users as $user)
    <li>
        {{ $user->username }} ({{ $user->email }})

        {{-- по ID --}}
        <a href="{{ route('users.studios.byId', $user->id) }}">
            студии по ID
        </a>

        {{-- по username (расширенный уровень) --}}
        <a href="{{ route('users.studios.byUsername', $user) }}">
            студии по username
        </a>
    </li>
@endforeach
</ul>