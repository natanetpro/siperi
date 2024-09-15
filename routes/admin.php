<?php

use App\Http\Controllers\Back\Admin\Auth\AuthController;
use App\Http\Controllers\Back\Admin\DashboardController;
use App\Http\Controllers\Back\Admin\MasterData\OperatorController;
use App\Http\Controllers\Back\Admin\MasterData\PembimbingController;
use App\Http\Controllers\Back\Admin\MasterData\PimpinanController;
use App\Http\Controllers\Back\Admin\PengajuanController;
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
            // Master Data
            Route::resource('pembimbing', PembimbingController::class);
            Route::resource('operator', OperatorController::class);
            Route::resource('pimpinan', PimpinanController::class);
        });

        // Pengajuan
        Route::get('/pengajuan', [PengajuanController::class, 'index'])->name('pengajuan.index');
        Route::get('/pengajuan/{id}', [PengajuanController::class, 'find'])->name('pengajuan.find');
        Route::put('/pengajuan/{id}', [PengajuanController::class, 'update'])->name('pengajuan.update');
    });
});
