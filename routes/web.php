<?php

use App\Http\Controllers\Back\AuthController;
use App\Http\Controllers\Back\Peserta\VerifikasiController;
use App\Http\Controllers\Back\Profile\ProfileController;
use App\Http\Controllers\Front\LandingPage\LandingPageController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/admin.php';
require __DIR__ . '/pembimbing.php';
require __DIR__ . '/peserta.php';

Route::get('/', [LandingPageController::class, 'index'])->name('landing-page.index');
Route::post('/daftar-riset', [LandingPageController::class, 'daftarRiset'])->name('landing-page.daftar.riset');
Route::post('/daftar-kkp', [LandingPageController::class, 'daftarKKP'])->name('landing-page.daftar.kkp');
Route::post('/daftar-prakerin', [LandingPageController::class, 'daftarPrakerin'])->name('landing-page.daftar.prakerin');
Route::get('verifikasi/{nama}', [VerifikasiController::class, 'verifyAccount'])->name('verifikasi');

Route::get('sertifikat/mahasiswa', function () {
    return view('pages.sertifikat.mahasiswa');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('authenticate');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::put('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
    Route::put('/profile/update-data-diri', [ProfileController::class, 'updateDataDiri'])->name('profile.update-data-diri');
    Route::put('/profile/update-sekolah', [ProfileController::class, 'updateSekolah'])->name('profile.update-sekolah');
    Route::put('/profile/update-kuliah', [ProfileController::class, 'updateUniversitas'])->name('profile.update-kuliah');
    Route::put('/profile/kegiatan', [ProfileController::class, 'updateKegiatan'])->name('profile.update-kegiatan');
});
