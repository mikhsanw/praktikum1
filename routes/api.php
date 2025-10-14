<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\KegiatanApiController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::middleware(['auth:sanctum', 'throttle:api'])->group(function () {
    Route::get('/kegiatans', [KegiatanApiController::class, 'index']);
    Route::get('/kegiatans/{id}', [KegiatanApiController::class, 'show']);
    Route::post('/kegiatans', [KegiatanApiController::class, 'store']);
    Route::put('/kegiatans/{id}', [KegiatanApiController::class, 'update']);
    Route::delete('/kegiatans/{id}', [KegiatanApiController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
