<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudioCommentController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\FeedController;

Route::get('/', [StudioController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::middleware('auth')->get('/feed', [FeedController::class, 'index'])->name('feed');
    
    Route::post('/users/{user:id}/friends', [FriendController::class, 'store'])
        ->name('users.friends.store');

    Route::delete('/users/{user:id}/friends', [FriendController::class, 'destroy'])
        ->name('users.friends.destroy');
    
    Route::post('/studios/{studio}/comments', [StudioCommentController::class, 'store'])
        ->name('studios.comments.store');

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

require __DIR__.'/auth.php';