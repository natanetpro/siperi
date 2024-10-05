<?php

use App\Models\UserKegiatan;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

// Artisan::command('inspire', function () {
//     $this->comment(Inspiring::quote());
// })->purpose('Display an inspiring quote')->hourly();

// Mengubah status kegiatan yang sudah selesai menjadi false
Schedule::call(function () {
    $expiredKegiatan = UserKegiatan::whereHas('kegiatan', function ($query) {
        $query->where('tanggal_selesai', '<', now());
    })->get();
    foreach ($expiredKegiatan as $kegiatan) {
        $kegiatan->update([
            'active' => false
        ]);
    }
})->daily();
