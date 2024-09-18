<?php

use App\Http\Controllers\Front\LandingPage\LandingPageController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/admin.php';
require __DIR__ . '/pembimbing.php';
require __DIR__ . '/peserta.php';

Route::get('/', [LandingPageController::class, 'index'])->name('landing-page.index');
Route::post('/daftar-riset', [LandingPageController::class, 'daftarRiset'])->name('landing-page.daftar.riset');
Route::post('/daftar-kkp', [LandingPageController::class, 'daftarKKP'])->name('landing-page.daftar.kkp');
Route::post('/daftar-prakerin', [LandingPageController::class, 'daftarPrakerin'])->name('landing-page.daftar.prakerin');
Route::get('/reload-captcha-riset', [LandingPageController::class, 'reloadCaptchaRiset'])->name('landing-page.reload-captcha.riset');
Route::get('/reload-captcha-kkp', [LandingPageController::class, 'reloadCaptchaKKP'])->name('landing-page.reload-captcha.kkp');
Route::get('/reload-captcha-prakerin', [LandingPageController::class, 'reloadCaptchaPrakerin'])->name('landing-page.reload-captcha.prakerin');
