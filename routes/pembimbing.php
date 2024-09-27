<?php

use App\Http\Controllers\Back\Pembimbing\Auth\AuthController;
use App\Http\Controllers\Back\Pembimbing\DaftarBimbingan\DaftarBimbinganController;
use App\Http\Controllers\Back\Pembimbing\DashboardController;
use App\Http\Controllers\Back\Pembimbing\LaporanAkhir\LaporanAkhirController;
use App\Http\Controllers\Back\Pembimbing\Logbook\LogbookController;
use App\Http\Controllers\Back\Pembimbing\Masukan\MasukanController;
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
        // Route::get('/daftar-bimbingan', [DaftarBimbinganController::class, 'index'])->name('daftar-bimbingan.index');
        // Route::get('/daftar-bimbingan/{id}', [DaftarBimbinganController::class, 'show'])->name('daftar-bimbingan.show');
        // Route::put('/daftar-bimbingan/{id}/approve-logbook', [DaftarBimbinganController::class, 'approveLogbook'])->name('daftar-bimbingan.approve-logbook');
        // Route::put('/daftar-bimbingan/{id}/reject-logbook', [DaftarBimbinganController::class, 'rejectLogbook'])->name('daftar-bimbingan.reject-logbook');
        // Route::put('/daftar-bimbingan/{id}/approve-laporan-akhir', [DaftarBimbinganController::class, 'approveLaporanAkhir'])->name('daftar-bimbingan.approve-laporan-akhir');
        // Route::put('/daftar-bimbingan/{id}/reject-laporan-akhir', [DaftarBimbinganController::class, 'rejectLaporanAkhir'])->name('daftar-bimbingan.reject-laporan-akhir');

        Route::get('/logbook', [LogbookController::class, 'index'])->name('logbook.index');
        Route::get('/logbook/{id}', [LogbookController::class, 'show'])->name('logbook.show');
        Route::put('/logbook/approve/{id}', [LogbookController::class, 'approveLogbook'])->name('logbook.approve');
        Route::put('/logbook/reject/{id}', [LogbookController::class, 'rejectLogbook'])->name('logbook.reject');

        Route::get('/laporan-akhir', [LaporanAkhirController::class, 'index'])->name('laporan-akhir.index');
        Route::get('/laporan-akhir/{id}', [LaporanAkhirController::class, 'show'])->name('laporan-akhir.show');
        Route::put('/laporan-akhir/approve/{id}', [LaporanAkhirController::class, 'approveLaporanAkhir'])->name('laporan-akhir.approve');
        Route::put('/laporan-akhir/reject/{id}', [LaporanAkhirController::class, 'rejectLaporanAkhir'])->name('laporan-akhir.reject');

        Route::get('/masukan', [MasukanController::class, 'index'])->name('masukan.index');
        Route::get('/masukan/{id}', [MasukanController::class, 'show'])->name('masukan.show');
        Route::post('/masukan', [MasukanController::class, 'store'])->name('masukan.store');
    });
});
