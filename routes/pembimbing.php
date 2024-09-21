<?php

use App\Http\Controllers\Back\Pembimbing\Auth\AuthController;
use App\Http\Controllers\Back\Pembimbing\DaftarBimbingan\DaftarBimbinganController;
use App\Http\Controllers\Back\Pembimbing\DashboardController;
use Illuminate\Support\Facades\Route;

Route::prefix('pembimbing')->name('pembimbing.')->group(function () {
    // Route::middleware('guest')->group(function () {
    //     Route::get('/login', [AuthController::class, 'index'])->name('login.index');
    //     Route::post('/login', [AuthController::class, 'login'])->name('login');
    // });

    Route::middleware('auth', 'is_role:Pembimbing')->group(function () {
        // Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

        // Daftar Bimbingan
        Route::get('/daftar-bimbingan', [DaftarBimbinganController::class, 'index'])->name('daftar-bimbingan.index');
        Route::get('/daftar-bimbingan/{id}', [DaftarBimbinganController::class, 'show'])->name('daftar-bimbingan.show');
        Route::put('/daftar-bimbingan/{id}/approve-logbook', [DaftarBimbinganController::class, 'approveLogbook'])->name('daftar-bimbingan.approve-logbook');
        Route::put('/daftar-bimbingan/{id}/reject-logbook', [DaftarBimbinganController::class, 'rejectLogbook'])->name('daftar-bimbingan.reject-logbook');
        Route::put('/daftar-bimbingan/{id}/approve-laporan-akhir', [DaftarBimbinganController::class, 'approveLaporanAkhir'])->name('daftar-bimbingan.approve-laporan-akhir');
        Route::put('/daftar-bimbingan/{id}/reject-laporan-akhir', [DaftarBimbinganController::class, 'rejectLaporanAkhir'])->name('daftar-bimbingan.reject-laporan-akhir');
    });
});
