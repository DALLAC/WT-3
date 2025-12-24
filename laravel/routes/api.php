<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudioApiController;
use App\Http\Controllers\Api\StudioCommentApiController;

Route::middleware('auth:api')->get('/me', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:api')->group(function () {
    Route::get('/studios', [StudioApiController::class, 'index']);
    Route::get('/studios/{studio}', [StudioApiController::class, 'show']);
    Route::post('/studios', [StudioApiController::class, 'store']);
    Route::put('/studios/{studio}', [StudioApiController::class, 'update']);

    Route::get('/studios/{studio}/comments', [StudioCommentApiController::class, 'index']);
    Route::post('/studios/{studio}/comments', [StudioCommentApiController::class, 'store']);
    Route::put('/comments/{comment}', [StudioCommentApiController::class, 'update']);
});