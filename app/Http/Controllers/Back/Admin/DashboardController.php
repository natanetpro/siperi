<?php

namespace App\Http\Controllers\Back\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\Pemohon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pemohon = Pemohon::count();
        $riset = Kegiatan::whereJenisKegiatan('Riset')->count();
        $kkp = Kegiatan::whereJenisKegiatan('KKP')->count();
        $prakerin = Kegiatan::whereJenisKegiatan('Prakerin')->count();
        // kirimkan data ke chartjs
        $kegiatan = Kegiatan::selectRaw('jenis_kegiatan, count(*) as total')
            ->groupBy('jenis_kegiatan')
            ->get();
        return view('pages.back.admin.dashboard.index', compact('pemohon', 'riset', 'kkp', 'prakerin', 'kegiatan'));
    }
}
