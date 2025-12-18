<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudioController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::get('/users/{user}/studios', [StudioController::class, 'indexByUser'])->name('users.post.index');
    Route::resource('studios', StudioController::class)->except(['index', 'show']);
    Route::get('/studios/{studio}/restore', [StudioController::class, 'restore'])->name('post.restore');
    Route::delete('/studios/{studio}/force-delete', [StudioController::class, 'forceDelete'])->name('post.force-delete');
});

require __DIR__.'/auth.php';
