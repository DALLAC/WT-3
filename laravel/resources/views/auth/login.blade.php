<x-guest-layout>
    <div class="auth-form">
        <h1 class="auth-form-title">Вход</h1>

        @if (session('status'))
            <div class="alert alert-success mb-3">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Логин или Email --}}
            <div class="mb-3">
                <label for="login" class="form-label">Логин или Email</label>
                <input
                    id="login"
                    type="text"
                    name="login"
                    class="form-control"
                    value="{{ old('login') }}"
                    required
                    autofocus
                    autocomplete="username"
                >
                @error('login')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Пароль --}}
            <div class="mb-3">
                <label for="password" class="form-label">Пароль</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    class="form-control"
                    required
                    autocomplete="current-password"
                >
                @error('password')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4">
                <a href="{{ route('register') }}" class="text-sm text-muted text-decoration-underline">
                    Нет аккаунта? Зарегистрироваться
                </a>

                <button type="submit" class="btn-auth">
                    Войти
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>