<?php

use App\Http\Controllers\Back\Admin\Auth\AuthController;
use App\Http\Controllers\Back\Admin\DashboardController;
use App\Http\Controllers\Back\Admin\MasterData\OperatorController;
use App\Http\Controllers\Back\Admin\MasterData\PembimbingController;
use App\Http\Controllers\Back\Admin\MasterData\PimpinanController;
use App\Http\Controllers\Back\Admin\MasterData\SertifikatController;
use App\Http\Controllers\Back\Admin\PengajuanController;
use App\Http\Controllers\Back\Admin\Setelan\ManajemenMenuController;
use App\Http\Controllers\Back\Admin\Setelan\ManejemenPeranController;
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
            Route::resource('sertifikat', SertifikatController::class)->except(['create', 'store', 'edit', 'update', 'destroy', 'show']);
            Route::get('sertifikat/mahasiswa/create', [SertifikatController::class, 'createSertifMahasiswa'])->name('sertifikat.create-mahasiswa');
            Route::post('sertifikat/mahasiswa', [SertifikatController::class, 'storeSertifMahasiswa'])->name('sertifikat.store-mahasiswa');
            Route::get('sertifikat/mahasiswa/edit', [SertifikatController::class, 'editSertifikatMahasiswa'])->name('sertifikat.edit-mahasiswa');
            Route::put('sertifikat/mahasiswa', [SertifikatController::class, 'updateSertifikatMahasiswa'])->name('sertifikat.update-mahasiswa');
            Route::get('sertifikat/siswa/create', [SertifikatController::class, 'createSertifSiswa'])->name('sertifikat.create-siswa');
            Route::post('sertifikat/siswa', [SertifikatController::class, 'storeSertifSiswa'])->name('sertifikat.store-siswa');
            Route::get('sertifikat/siswa/edit', [SertifikatController::class, 'editSertifSiswa'])->name('sertifikat.edit-siswa');
            Route::put('sertifikat/siswa', [SertifikatController::class, 'updateSertifSiswa'])->name('sertifikat.update-siswa');
        });

        // Pengajuan
        Route::get('/pengajuan', [PengajuanController::class, 'index'])->name('pengajuan.index');
        Route::get('/pengajuan/{id}', [PengajuanController::class, 'find'])->name('pengajuan.find');
        Route::put('/pengajuan/{id}', [PengajuanController::class, 'update'])->name('pengajuan.update');
        Route::put('/pengajuan/{id}/set-pembimbing', [PengajuanController::class, 'setPembimbing'])->name('pengajuan.set-pembimbing');

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
