<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Rockstar Games') }}</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    {{-- Простая навигация, без логотипа-картинки --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Rockstar Games</a>

            <div class="ms-auto">
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm me-2">Войти</a>
                <a href="{{ route('register') }}" class="btn btn-success btn-sm">Регистрация</a>
            </div>
        </div>
    </nav>

    {{-- Контейнер для формы (login / register и т.п.) --}}
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>