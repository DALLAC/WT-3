<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudioController;
Route::get('/', [StudioController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return redirect()->route('home'); // или route('studios.index') / просто '/'
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    
    Route::get('/users', [UserController::class, 'index'])
        ->name('users.index');

    Route::get('/users/{user}/studios', [StudioController::class, 'indexByUser'])
        ->name('users.studios.index');

    Route::resource('studios', StudioController::class)
        ->except(['index', 'show']);

    Route::post('/studios/{studio}/restore', [StudioController::class, 'restore'])
        ->name('studios.restore');

    Route::delete('/studios/{studio}/force-delete', [StudioController::class, 'forceDelete'])
        ->name('studios.force-delete');
});

require __DIR__.'/auth.php';
