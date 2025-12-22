<x-guest-layout>
    <div class="auth-form">
        <h1 class="auth-form-title">Регистрация</h1>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Имя --}}
            <div class="mb-3">
                <label for="name" class="form-label">Имя</label>
                <input
                    id="name"
                    type="text"
                    name="name"
                    class="form-control"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    autocomplete="name"
                >
                @error('name')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Логин --}}
            <div class="mb-3">
                <label for="username" class="form-label">Логин</label>
                <input
                    id="username"
                    type="text"
                    name="username"
                    class="form-control"
                    value="{{ old('username') }}"
                    required
                    autocomplete="username"
                >
                @error('username')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    class="form-control"
                    value="{{ old('email') }}"
                    required
                    autocomplete="email"
                >
                @error('email')
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
                    autocomplete="new-password"
                >
                @error('password')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Подтверждение пароля --}}
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Подтверждение пароля</label>
                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    class="form-control"
                    required
                    autocomplete="new-password"
                >
                @error('password_confirmation')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4">
                <a href="{{ route('login') }}" class="text-sm text-muted text-decoration-underline">
                    Уже зарегистрированы?
                </a>

                <button type="submit" class="btn-auth">
                    Зарегистрироваться
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>