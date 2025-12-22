<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\UserController;

// Главная — список студий (у тебя в StudioController@index логика по ролям)
Route::get('/', [StudioController::class, 'index'])->name('home');

// dashboard Breeze — просто редиректим на главную
Route::get('/dashboard', function () {
    return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');

// Всё, что ниже — только для авторизованных
Route::middleware('auth')->group(function () {

    // Список всех пользователей (навигация по ним)
    Route::get('/users', [UserController::class, 'index'])
        ->name('users.index');

    // Студии пользователя по username (расширенный уровень)
    // /users/admin/studios, /users/user1/studios и т.п.
    Route::get('/users/{user:username}/studios', [StudioController::class, 'indexByUser'])
        ->name('users.studios.byUsername');

    // Студии пользователя по ID (чтобы формально было "перебирать ID в адресной строке")
    // /users/id/1/studios, /users/id/2/studios и т.п.
    Route::get('/users/id/{id}/studios', [StudioController::class, 'indexById'])
        ->whereNumber('id')
        ->name('users.studios.byId');

    // CRUD для студий (кроме index, он уже на '/')
    Route::resource('studios', StudioController::class)
        ->except(['index']);

    // Восстановление мягко удалённой студии (для админа)
    Route::post('/studios/{studio}/restore', [StudioController::class, 'restore'])
        ->name('studios.restore');

    // Полное удаление студии (для админа)
    Route::delete('/studios/{studio}/force-delete', [StudioController::class, 'forceDelete'])
        ->name('studios.force-delete');
});

// Маршруты аутентификации Breeze (login/register и т.д.)
require __DIR__.'/auth.php';