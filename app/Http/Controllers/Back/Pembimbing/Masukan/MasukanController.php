<?php

namespace App\Http\Controllers\Back\Pembimbing\Masukan;

use App\Http\Controllers\Controller;
use App\Models\MasukanSaran;
use App\Models\UserKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasukanController extends Controller
{
    public $title = 'Masukan & Saran';
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $peserta = UserKegiatan::with(['user', 'user.pemohon', 'kegiatan'])->wherePembimbingId(auth()->user()->id)->get();
            return datatables()->of($peserta)
                ->addColumn('action', function ($data) {
                    $button = '<a href="' . route('pembimbing.masukan.show', $data->id) . '" class="btn btn-warning btn-sm"><i class="ti ti-pencil"></i></a>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.back.pembimbing.masukan.index', [
            'title' => $this->title
        ]);
    }

    public function show($id)
    {
        $peserta = UserKegiatan::with(['user', 'user.pemohon', 'kegiatan'])->wherePembimbingId(auth()->user()->id)->findOrFail($id);
        return view('pages.back.pembimbing.masukan.show', [
            'title' => $this->title,
            'peserta' => $peserta,
            'masukan' => MasukanSaran::whereUserKegiatanId($id)->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'masukan_saran' => 'required',
        ]);

        DB::beginTransaction();
        try {
            MasukanSaran::create([
                'user_kegiatan_id' => $request->user_kegiatan_id,
                'masukan_saran' => $request->masukan_saran,
            ]);
            DB::commit();
            return redirect()->back()->with('success', 'Berhasil menambahkan masukan & saran');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menambahkan masukan & saran');
        }
    }
}
