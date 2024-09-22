<?php

use App\Http\Controllers\Back\Peserta\Auth\AuthController;
use App\Http\Controllers\Back\Peserta\DashboardController;
use App\Http\Controllers\Back\Peserta\Kegiatan\KegiatanController;
use App\Http\Controllers\Back\Peserta\LaporanAkhir\LaporanAkhirController;
use App\Http\Controllers\Back\Peserta\Logbook\LogbookController;
use Illuminate\Support\Facades\Route;

Route::prefix('peserta')->name('peserta.')->group(function () {
    // Route::middleware('guest')->group(function () {
    //     Route::get('/login', [AuthController::class, 'index'])->name('login.index');
    //     Route::post('/login', [AuthController::class, 'login'])->name('login');
    // });

    Route::middleware(['auth', 'is_role:Pemohon'])->group(function () {
        // Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

        // Kegiatan Routes
        // Route::get('/kegiatan', [KegiatanController::class, 'index'])->name('kegiatan.index');
        // Route::post('/kegiatan', [KegiatanController::class, 'store'])->name('kegiatan.store');
        // Route::get('/kegiatan/{id}', [KegiatanController::class, 'find'])->name('kegiatan.find');
        // Route::put('/kegiatan/{id}', [KegiatanController::class, 'update'])->name('kegiatan.update');

        // Logbook Routes
        Route::resource('logbook', LogbookController::class)->only(['index', 'store', 'show', 'update']);
        Route::resource('laporan-akhir', LaporanAkhirController::class)->only(['index', 'store', 'show', 'update']);

        // // Laporan Akhir Routes
        // Route::post('/laporan-akhir', [KegiatanController::class, 'storeLaporanAkhir'])->name('laporan_akhir.store');
        // Route::put('/laporan-akhir/{id}', [KegiatanController::class, 'updateLaporanAkhir'])->name('laporan_akhir.update');

        // Certificate Routes
        Route::get('/sertifikat', [KegiatanController::class, 'download_certificate'])->name('sertifikat.index');
    });
});
