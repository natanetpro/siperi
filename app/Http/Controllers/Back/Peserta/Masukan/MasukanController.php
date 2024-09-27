<?php

namespace App\Http\Controllers\Back\Peserta\Masukan;

use App\Http\Controllers\Controller;
use App\Models\MasukanSaran;
use App\Models\UserKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MasukanController extends Controller
{
    public $title = 'Masukan & Saran';

    public function index()
    {
        $kegiatan = UserKegiatan::with(['masukan', 'pembimbing'])->whereUserId(Auth::id())->first();

        return view('pages.back.peserta.masukan.index', [
            'title' => $this->title,
            'kegiatan' => $kegiatan
        ]);
    }
}
