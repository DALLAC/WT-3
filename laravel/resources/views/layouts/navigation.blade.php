
@auth
<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">Студии</a>

        <div class="d-flex align-items-center flex-wrap gap-2">
            <a href="{{ url('/') }}" class="btn btn-outline-light btn-sm">
                Мои студии
            </a>

            <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm">
                Пользователи
            </a>

            <a href="{{ route('feed') }}" class="btn btn-warning btn-sm">
                Лента
            </a>

            <a href="{{ route('studios.create') }}" class="btn btn-success btn-sm">
                Добавить
            </a>

            <a href="{{ route('profile.edit') }}" class="btn btn-outline-info btn-sm">
                {{ auth()->user()->username ?? auth()->user()->name }}
            </a>

            <span class="text-white-50 small">
                {{ auth()->user()->email }}
            </span>

            <form action="{{ route('logout') }}" method="POST" class="d-inline m-0">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm">
                    Выйти
                </button>
            </form>
        </div>
    </div>
</nav>
@endauth

