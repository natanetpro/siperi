<?php

use App\Http\Controllers\Back\Admin\Auth\AuthController;
use App\Http\Controllers\Back\Admin\DashboardController;
use App\Http\Controllers\Back\Admin\MasterData\PembimbingController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'index'])->name('login.index');
        Route::post('/login', [AuthController::class, 'login'])->name('login');
    });

    Route::middleware('auth', 'is_role:Administrator')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        // Master Data
        Route::prefix('master-data')->name('master-data.')->group(function () {
            Route::resource('pembimbing', PembimbingController::class);
        });
    });
});
