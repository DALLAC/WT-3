<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>{{ $studio->title }} - Детали</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>

<div class="container mt-4 mb-4">
    <a href="/" class="btn btn-outline-secondary">&larr; На главную</a>
</div>

<div class="container">
    <div class="card shadow-sm">
        <div class="row g-0">
            
            <div class="col-md-4 bg-light d-flex align-items-center justify-content-center p-3">
                <img src="{{ Str::startsWith($studio->image, '/') ? $studio->image : asset('storage/' . $studio->image) }}" 
                     class="img-fluid rounded" 
                     alt="{{ $studio->title }}"
                     style="max-height: 300px;">
            </div>
            
            <div class="col-md-8">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <h1 class="card-title display-6">{{ $studio->title }}</h1>
                        <span class="badge bg-primary fs-6">{{ $studio->location }}</span>
                    </div>
                    
                    <p class="text-muted mb-2">
                        Основана: 
                        <strong>{{ $studio->founded_at ? $studio->founded_at->format('d.m.Y') : 'Н/Д' }}</strong>
                    </p>

                    <hr>

                    <div class="mb-4">
                        <h5>Описание:</h5>
                
                        <div class="card-text fs-5">
                            {!! $studio->description !!}
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-auto">
                        <a href="{{ route('studios.edit', $studio->id) }}" class="btn btn-primary">Редактировать</a>
                        
                        <form action="{{ route('studios.destroy', $studio->id) }}" method="POST" onsubmit="return confirm('Удалить?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h2 class="text-xl font-semibold mt-8">Комментарии</h2>

    <div class="mt-4 space-y-3">
        @foreach($studio->comments->sortByDesc('created_at') as $comment)
            @php
                $isFriendComment = auth()->check() && in_array($comment->user_id, $friendIds ?? [], true);
            @endphp

            <div style="padding:10px; border:1px solid #ccc; margin:8px 0; background: {{ $isFriendComment ? '#fff7cc' : '#ffffff' }};">
                <div style="font-size: 12px; color:#666;">
                    {{ $comment->user->username ?? $comment->user->name }}
                    @if($isFriendComment)
                        <strong>(друг)</strong>
                    @endif
                    — {{ $comment->created_at->format('d.m.Y H:i') }}
                </div>

                <div style="margin-top:6px; white-space: pre-wrap;">{{ $comment->text }}</div>
            </div>
        @endforeach
    </div>

    @auth
        <form method="POST" action="{{ route('studios.comments.store', $studio) }}" class="mt-6">
            @csrf

            <label class="block font-medium">Добавить комментарий</label>
            <textarea name="text" class="w-full border rounded p-2 mt-2" rows="4" required>{{ old('text') }}</textarea>

            @error('text')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror

            <button type="submit" class="mt-2 px-4 py-2 rounded bg-black text-white">
                Отправить
            </button>
        </form>
    @else
        <div class="mt-6 text-gray-600">Войдите, чтобы оставить комментарий.</div>
    @endauth
</div>


</body>
</html>