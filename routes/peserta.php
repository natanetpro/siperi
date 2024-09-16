<?php

use App\Http\Controllers\Back\Peserta\Auth\AuthController;
use App\Http\Controllers\Back\Peserta\DashboardController;
use Illuminate\Support\Facades\Route;

Route::prefix('peserta')->name('peserta.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'index'])->name('login.index');
        Route::post('/login', [AuthController::class, 'login'])->name('login');
    });

    Route::middleware(['auth', 'is_role:Pemohon'])->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    });
});
