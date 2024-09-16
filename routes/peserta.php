<?php

use App\Http\Controllers\Back\Peserta\Auth\AuthController;
use App\Http\Controllers\Back\Peserta\DashboardController;
use App\Http\Controllers\Back\Peserta\Kegiatan\KegiatanController;
use Illuminate\Support\Facades\Route;

Route::prefix('peserta')->name('peserta.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'index'])->name('login.index');
        Route::post('/login', [AuthController::class, 'login'])->name('login');
    });

    Route::middleware(['auth', 'is_role:Pemohon'])->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

        // Kegiatan Routes
        Route::get('/kegiatan', [KegiatanController::class, 'index'])->name('kegiatan.index');
        Route::post('/kegiatan', [KegiatanController::class, 'store'])->name('kegiatan.store');
        Route::get('/kegiatan/{id}', [KegiatanController::class, 'find'])->name('kegiatan.find');
        Route::put('/kegiatan/{id}', [KegiatanController::class, 'update'])->name('kegiatan.update');
    });
});
