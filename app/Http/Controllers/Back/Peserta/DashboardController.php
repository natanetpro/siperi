<?php

namespace App\Http\Controllers\Back\Peserta;

use App\Http\Controllers\Controller;
use App\Models\Logbook;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $menunggu = Logbook::whereApprovalPembimbing('Menunggu')->whereHas('userKegiatan', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->count();
        $diterima = Logbook::whereApprovalPembimbing('Disetujui')->whereHas('userKegiatan', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->count();
        $ditolak = Logbook::whereApprovalPembimbing('Ditolak')->whereHas('userKegiatan', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->count();
        return view('pages.back.peserta.dashboard.index', compact('menunggu', 'diterima', 'ditolak'));
    }
}
