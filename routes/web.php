<?php

use App\Http\Controllers\Front\LandingPage\LandingPageController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/admin.php';

Route::get('/', [LandingPageController::class, 'index'])->name('landing-page.index');
Route::post('/daftar', [LandingPageController::class, 'daftar'])->name('landing-page.daftar');
