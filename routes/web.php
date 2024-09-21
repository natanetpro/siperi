<?php

use App\Http\Controllers\Back\AuthController;
use App\Http\Controllers\Front\LandingPage\LandingPageController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/admin.php';
require __DIR__ . '/pembimbing.php';
require __DIR__ . '/peserta.php';

Route::get('/', [LandingPageController::class, 'index'])->name('landing-page.index');
Route::post('/daftar-riset', [LandingPageController::class, 'daftarRiset'])->name('landing-page.daftar.riset');
Route::post('/daftar-kkp', [LandingPageController::class, 'daftarKKP'])->name('landing-page.daftar.kkp');
Route::post('/daftar-prakerin', [LandingPageController::class, 'daftarPrakerin'])->name('landing-page.daftar.prakerin');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('authenticate');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
