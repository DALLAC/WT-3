<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>{{ $studio->exists ? 'Редактирование' : 'Добавить студию' }}</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>

<div class="container mt-5" style="max-width: 800px;">
    <div class="card">
        <div class="card-header {{ $studio->exists ? 'bg-warning' : 'bg-success' }} text-white">
            <h4>{{ $studio->exists ? 'Редактирование студии: ' . $studio->title : 'Добавление новой студии' }}</h4>
        </div>
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
                </div>
            @endif

            <form action="{{ $studio->exists ? route('studios.update', $studio->id) : route('studios.store') }}" 
                  method="POST" 
                  enctype="multipart/form-data">
                
                @csrf
                
                @if($studio->exists)
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label class="form-label">Название</label>
                    <input type="text" name="title" class="form-control" 
                           value="{{ old('title', $studio->title ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Метка (Location)</label>
                    <input type="text" name="location" class="form-control" 
                           value="{{ old('location', $studio->location ?? '') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Краткое описание</label>
                    <textarea name="short_description" class="form-control" rows="2">{{ old('short_description', $studio->short_description ?? '') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Полное описание</label>
                    <textarea name="description" class="form-control" rows="5" required>{{ old('description', $studio->description ?? '') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Дата основания</label>
                    <input type="date" name="founded_at" class="form-control" 
                           value="{{ old('founded_at', $studio->founded_at ? $studio->founded_at->format('Y-m-d') : '') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Картинка</label>
                    <input type="file" name="image" class="form-control">
                    @if($studio->exists && $studio->image)
                        <div class="mt-2">
                            <img src="{{ Str::startsWith($studio->image, '/') ? $studio->image : asset('storage/' . $studio->image) }}" height="60">
                            <small class="text-muted ms-2">Текущая</small>
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn {{ $studio->exists ? 'btn-warning' : 'btn-success' }}">
                    {{ $studio->exists ? 'Обновить' : 'Сохранить' }}
                </button>
                <a href="/" class="btn btn-secondary">Отмена</a>
            </form>
        </div>
    </div>
</div>

</body>
</html>