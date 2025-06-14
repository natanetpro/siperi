<?php

namespace App\Http\Controllers\Back\Pembimbing;

use App\Http\Controllers\Controller;
use App\Models\Logbook;
use App\Models\UserKegiatan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pesertaBimbingan = UserKegiatan::wherePembimbingId(auth()->user()->id)->count();
        $logbookMenunggu = Logbook::whereApprovalPembimbing('Menunggu')->whereHas('userKegiatan', function ($query) {
            $query->wherePembimbingId(auth()->user()->id);
        })->count();
        return view('pages.back.pembimbing.dashboard.index', compact('pesertaBimbingan', 'logbookMenunggu'));
    }
}
