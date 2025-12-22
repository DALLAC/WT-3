<?php

namespace App\Http\Controllers;

use App\Models\Studio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class StudioController extends Controller
{
    /**
     * Не используется в ресурсных маршрутах (они except['index']),
     * но можно оставить для главной страницы.
     */
    public function index()
    {
        if (Auth::check()) {
            $studios = Studio::where('user_id', Auth::id())->get();
        } else {
            $studios = collect();
        }

        return view('welcome', compact('studios'));
    }


    /**
     * Список студий конкретного пользователя по username.
     * /users/{user}/studios
     * {user} → User через Route Model Binding (getRouteKeyName() = 'username')
     */
    public function indexByUser(User $user)
    {
        $viewer = Auth::user();

        $query = $user->studios()->orderByDesc('created_at');

        if ($viewer && $viewer->is_admin) {
            $query->withTrashed();
        }

        $studios = $query->get();

        return view('studios.index', compact('studios', 'user'));
    }

    public function indexById(int $id)
    {
        $user = User::findOrFail($id);
        return $this->indexByUser($user);
    }
    /**
     * Форма создания новой студии.
     * Создавать может любой авторизованный.
     */
    public function create()
    {
        Gate::authorize('create-studio');

        return view('studios.form', ['studio' => new Studio()]);
    }

    /**
     * Сохранение новой студии.
     * user_id проставится в модели Studio::booted()
     */
    public function store(Request $request)
    {
        Gate::authorize('create-studio');

        $request->validate([
            'title'             => 'required|string|max:255',
            'location'          => 'nullable|string|max:100',
            'short_description' => 'nullable|string|max:500',
            'description'       => 'required|string',
            'founded_at'        => 'nullable|date',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only([
            'title',
            'location',
            'short_description',
            'description',
            'founded_at',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads', 'public');
            $data['image'] = $path;
        }

        Studio::create($data);

        // после создания — на список студий текущего пользователя
        return redirect()
            ->route('users.studios.byUsername', Auth::user())
            ->with('success', 'Студия успешно добавлена!');
    }

    /**
     * Показ одной студии (если используешь).
     * Здесь можно не ставить Gate, по заданию не обязательно.
     */
    public function show(Studio $studio)
    {
        return view('studios.show', compact('studio'));
    }

    /**
     * Форма редактирования студии.
     * Редактировать может только владелец или админ.
     */
    public function edit(Studio $studio)
    {
        Gate::authorize('update-studio', $studio);

        return view('studios.form', ['studio' => $studio]);
    }

    /**
     * Обновление студии.
     */
    public function update(Request $request, Studio $studio)
    {
        Gate::authorize('update-studio', $studio);

        $request->validate([
            'title'             => 'required|string|max:255',
            'location'          => 'nullable|string|max:100',
            'short_description' => 'nullable|string|max:500',
            'description'       => 'required|string',
            'founded_at'        => 'nullable|date',
            'image'             => 'nullable|image|max:2048',
        ]);

        $data = $request->only([
            'title',
            'location',
            'short_description',
            'description',
            'founded_at',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads', 'public');
            $data['image'] = $path;
        }

        $studio->update($data);

        return redirect()
            ->route('users.studios.index', $studio->user)
            ->with('success', 'Студия обновлена!');
    }

    /**
     * Мягкое удаление (Soft Delete).
     * Обычный пользователь может удалять только свои,
     * админ — любые.
     */
    public function destroy(Studio $studio)
    {
        Gate::authorize('delete-studio', $studio);

        $studio->delete();

        return back()->with('success', 'Студия удалена (мягкое удаление).');
    }

    /**
     * Восстановление мягко удалённой студии.
     * Доступно только администратору (Gate: restore-studio).
     */
    public function restore($id)
    {
        $studio = Studio::withTrashed()->findOrFail($id);

        Gate::authorize('restore-studio', $studio);

        $studio->restore();

        return back()->with('success', 'Студия восстановлена.');
    }

    /**
     * Полное удаление студии (без возможности восстановления).
     * Только админ.
     */
    public function forceDelete($id)
    {
        $studio = Studio::withTrashed()->findOrFail($id);

        Gate::authorize('force-delete-studio', $studio);

        $studio->forceDelete();

        return back()->with('success', 'Студия удалена окончательно.');
    }
}