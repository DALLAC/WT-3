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
</div>

</body>
</html>