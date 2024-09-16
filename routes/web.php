<?php

use App\Http\Controllers\Front\LandingPage\LandingPageController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/admin.php';

Route::get('/', [LandingPageController::class, 'index'])->name('landing-page.index');
Route::post('/daftar-riset', [LandingPageController::class, 'daftarRiset'])->name('landing-page.daftar.riset');
Route::post('/daftar-kkp', [LandingPageController::class, 'daftarKKP'])->name('landing-page.daftar.kkp');
Route::post('/daftar-prakerin', [LandingPageController::class, 'daftarPrakerin'])->name('landing-page.daftar.prakerin');
