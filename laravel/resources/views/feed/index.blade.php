<h1>Лента</h1>

@if($studios->isEmpty())
    <p>Пока нет новых студий друзей.</p>
@else
    <ul>
        @foreach($studios as $studio)
            <li>
                <a href="{{ route('studios.show', $studio) }}">
                    {{ $studio->title }}
                </a>
                — автор: {{ $studio->user->username }}
                — {{ $studio->created_at->format('d.m.Y H:i') }}
            </li>
        @endforeach
    </ul>
@endif