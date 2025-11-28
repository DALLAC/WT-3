<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudioController; 

Route::get('/', [StudioController::class, 'index']);

Route::resource('studios', StudioController::class);

#Route::get('/', [StudioController::class, 'index'])->name('studios.index');

#Route::get('/studios/create', [StudioController::class, 'create'])->name('studios.create');
#Route::post('/studios', [StudioController::class, 'store'])->name('studios.store');

#Route::get('/studios/{studio}', [StudioController::class, 'show'])->name('studios.show');

#Route::get('/studios/{studio}/edit', [StudioController::class, 'edit'])->name('studios.edit');
#Route::put('/studios/{studio}', [StudioController::class, 'update'])->name('studios.update');

#Route::delete('/studios/{studio}', [StudioController::class, 'destroy'])->name('studios.destroy');