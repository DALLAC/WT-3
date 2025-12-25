<x-app-layout>
    <x-slot name="header">
        <h2 class="h3 mb-0 text-white">Пользователи</h2>
    </x-slot>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h1 class="h4 mb-0">
                            <i class="bi bi-people-fill"></i> Все пользователи
                        </h1>
                        <span class="badge bg-light text-dark">{{ $users->count() }} чел.</span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Пользователь</th>
                                        <th>Email</th>
                                        <th>Студии</th>
                                        <th>Действия</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>
                                                <strong>{{ $user->username }}</strong>
                                                @if(auth()->id() === $user->id)
                                                    <span class="badge bg-success ms-1">Вы</span>
                                                @endif
                                            </td>
                                            <td class="text-muted">{{ $user->email }}</td>
                                            <td>
                                                <a href="{{ route('users.studios.byId', $user->id) }}" 
                                                   class="btn btn-sm btn-outline-primary me-1">
                                                    <i class="bi bi-hash"></i> по ID
                                                </a>
                                                <a href="{{ route('users.studios.byUsername', $user) }}" 
                                                   class="btn btn-sm btn-outline-secondary">
                                                    <i class="bi bi-at"></i> по username
                                                </a>
                                            </td>
                                            <td>
                                                @auth
                                                    @if(auth()->id() !== $user->id)
                                                        @if(in_array($user->id, $friendIds ?? [], true))
                                                            <form method="POST" 
                                                                  action="{{ route('users.friends.destroy', $user->id) }}" 
                                                                  class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger">
                                                                    <i class="bi bi-person-dash"></i> Удалить
                                                                </button>
                                                            </form>
                                                        @else
                                                            <form method="POST" 
                                                                  action="{{ route('users.friends.store', $user->id) }}" 
                                                                  class="d-inline">
                                                                @csrf
                                                                <button type="submit" class="btn btn-sm btn-success">
                                                                    <i class="bi bi-person-plus"></i> Добавить
                                                                </button>
                                                            </form>
                                                        @endif
                                                    @endif
                                                @endauth
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>