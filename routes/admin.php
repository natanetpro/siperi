<?php

use App\Http\Controllers\Back\Admin\Auth\AuthController;
use App\Http\Controllers\Back\Admin\DashboardController;
use App\Http\Controllers\Back\Admin\MasterData\OperatorController;
use App\Http\Controllers\Back\Admin\MasterData\PembimbingController;
use App\Http\Controllers\Back\Admin\MasterData\PimpinanController;
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

            Route::prefix('menu')->name('menu.')->group(function () {
                // panel
                Route::get('panel', [ManajemenMenuController::class, 'index'])->name('panel.index');
                Route::get('panel/create', [ManajemenMenuController::class, 'create'])->name('panel.create');
                Route::post('panel', [ManajemenMenuController::class, 'store'])->name('panel.store');
                Route::get('panel/{panel}/edit', [ManajemenMenuController::class, 'edit'])->name('panel.edit');
                Route::put('panel/{panel}', [ManajemenMenuController::class, 'update'])->name('panel.update');
                Route::delete('panel/{panel}', [ManajemenMenuController::class, 'destroy'])->name('panel.destroy');
            });
        });
    });
});
