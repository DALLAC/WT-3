<x-app-layout>
    <x-slot name="header">
        <h2 class="h3 mb-0 text-white">Лента новостей</h2>
    </x-slot>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h1 class="h4 mb-0">
                            <i class="bi bi-newspaper"></i> Лента студий друзей
                        </h1>
                    </div>
                    <div class="card-body">
                        @if($studios->isEmpty())
                            <div class="alert alert-info mb-0" role="alert">
                                <i class="bi bi-info-circle"></i>
                                Пока нет новых студий от ваших друзей. Добавьте друзей на странице 
                                <a href="{{ route('users.index') }}" class="alert-link">пользователей</a>.
                            </div>
                        @else
                            <div class="list-group list-group-flush">
                                @foreach($studios as $studio)
                                    <div class="list-group-item list-group-item-action">
                                        <div class="d-flex w-100 justify-content-between align-items-start">
                                            <div class="flex-grow-1">
                                                <h5 class="mb-1">
                                                    <a href="{{ route('studios.show', $studio) }}" 
                                                       class="text-decoration-none text-dark fw-bold">
                                                        {{ $studio->title }}
                                                    </a>
                                                </h5>
                                                <p class="mb-1 text-muted">
                                                    <i class="bi bi-person-circle"></i>
                                                    <strong>Автор:</strong> {{ $studio->user->username }}
                                                </p>
                                            </div>
                                            <small class="text-muted">
                                                <i class="bi bi-clock"></i>
                                                {{ $studio->created_at->format('d.m.Y H:i') }}
                                            </small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>