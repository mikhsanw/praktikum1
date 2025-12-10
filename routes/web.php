<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/file/{path}/{status?}', function ($path, $status = null) {

    $path = urldecode($path);

    if (! Storage::disk('public')->exists($path)) {
        abort(404);
    }
    if ($status === 'download') {
        return Storage::disk('public')->download($path);
    }

    return response()->file(Storage::disk('public')->path($path));

})->where('path', '.*');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::resource('users', \App\Http\Controllers\UserController::class);

    });

    Route::middleware(['auth', 'role:user'])->group(function () {
        Route::resource('anggota', \App\Http\Controllers\AnggotaController::class);
        Route::resource('kegiatan', \App\Http\Controllers\KegiatanController::class);

    });

    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'showProfile'])->name('profile.show');
    Route::put('/profile', [\App\Http\Controllers\ProfileController::class, 'updateProfile'])->name('profile.update');
});

Route::get('/files/{id}/{action}', function ($id, $action) {
    $file = \App\Models\File::findOrFail($id);

    return $file->handleAction($action);
})->name('files.action');
