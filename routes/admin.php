<?php

use App\Http\Controllers\Back\Admin\Auth\AuthController;
use App\Http\Controllers\Back\Admin\DashboardController;
use App\Http\Controllers\Back\Admin\KegiatanController;
use App\Http\Controllers\Back\Admin\LaporanAkhir\LaporanAkhirController;
use App\Http\Controllers\Back\Admin\Logbook\LogbookController;
use App\Http\Controllers\Back\Admin\MasterData\OperatorController;
use App\Http\Controllers\Back\Admin\MasterData\PembimbingController;
use App\Http\Controllers\Back\Admin\MasterData\PenggunaController;
use App\Http\Controllers\Back\Admin\MasterData\PimpinanController;
use App\Http\Controllers\Back\Admin\MasterData\SertifikatController;
use App\Http\Controllers\Back\Admin\PengajuanController;
use App\Http\Controllers\Back\Admin\Sertifikat\SertifikatController as MenuSertifikatController;
use App\Http\Controllers\Back\Admin\Setelan\ManajemenMenuController;
use App\Http\Controllers\Back\Admin\Setelan\ManejemenPeranController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    // Route::middleware('guest')->group(function () {
    //     Route::get('/login', [AuthController::class, 'index'])->name('login.index');
    //     Route::post('/login', [AuthController::class, 'login'])->name('login');
    // });

    Route::middleware('auth', 'is_role:Administrator|Pimpinan|Operator')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
        // Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        // Master Data
        Route::prefix('master-data')->name('master-data.')->group(function () {
            // Master Data
            Route::resource('pembimbing', PembimbingController::class);
            // Route::resource('operator', OperatorController::class);
            // Route::resource('pimpinan', PimpinanController::class);
            Route::resource('pengguna', PenggunaController::class);
            Route::resource('sertifikat', SertifikatController::class)->except(['create', 'store', 'edit', 'update', 'destroy', 'show']);
            Route::get('/sertifikat', [SertifikatController::class, 'index'])->name('sertifikat.index');
            Route::post('/sertifikat', [SertifikatController::class, 'createOrUpdate'])->name('sertifikat.createOrUpdate');
        });

        // Kegiatan
        // Route::get('/kegiatan', [KegiatanController::class, 'index'])->name('kegiatan.index');
        // Route::get('/kegiatan/{id}', [KegiatanController::class, 'find'])->name('kegiatan.find');

        // Logbook
        Route::get('/logbook', [LogbookController::class, 'index'])->name('logbook.index');
        Route::get('/logbook/{id}', [LogbookController::class, 'find'])->name('logbook.find');

        // Laporan Akhir
        Route::get('/laporan-akhir', [LaporanAkhirController::class, 'index'])->name('laporan-akhir.index');
        Route::get('/laporan-akhir/{id}', [LaporanAkhirController::class, 'find'])->name('laporan-akhir.find');

        // Pengajuan
        Route::get('/pengajuan', [PengajuanController::class, 'index'])->name('pengajuan.index');
        Route::get('/pengajuan/{id}', [PengajuanController::class, 'find'])->name('pengajuan.find');
        Route::put('/pengajuan/{id}', [PengajuanController::class, 'update'])->name('pengajuan.update');
        Route::put('/pengajuan/{id}/set-pembimbing', [PengajuanController::class, 'setPembimbing'])->name('pengajuan.set-pembimbing');

        // Sertifikat
        Route::get('/sertifikat', [MenuSertifikatController::class, 'index'])->name('sertifikat.index');
        Route::get('/sertifikat/{id}', [MenuSertifikatController::class, 'downloadCertificate'])->name('sertifikat.find');

        // Setelan
        Route::prefix('setelan')->name('setelan.')->group(function () {
            // peran
            Route::resource('peran', ManejemenPeranController::class);

            // Route::prefix('menu')->name('menu.')->group(function () {
            //     // panel
            //     Route::resource('panel', ManajemenMenuController::class);

            //     // modul
            //     Route::get('modul/{panel}', [ManajemenMenuController::class, 'index_modul'])->name('modul.index');
            //     Route::get('modul/{panel}/create', [ManajemenMenuController::class, 'create_modul'])->name('modul.create');
            //     Route::post('modul/{panel}', [ManajemenMenuController::class, 'store_modul'])->name('modul.store');
            //     Route::get('modul/{modul}/edit', [ManajemenMenuController::class, 'edit_modul'])->name('modul.edit');
            //     Route::put('modul/{modul}', [ManajemenMenuController::class, 'update_modul'])->name('modul.update');
            //     Route::delete('modul/{modul}', [ManajemenMenuController::class, 'destroy_modul'])->name('modul.destroy');
            // });
        });
    });
});
