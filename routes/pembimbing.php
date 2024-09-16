<?php

use App\Http\Controllers\Back\Pembimbing\Auth\AuthController;
use App\Http\Controllers\Back\Pembimbing\DashboardController;
use Illuminate\Support\Facades\Route;

Route::prefix('pembimbing')->name('pembimbing.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'index'])->name('login.index');
        Route::post('/login', [AuthController::class, 'login'])->name('login');
    });

    Route::middleware('auth', 'is_role:Pembimbing')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    });
});
