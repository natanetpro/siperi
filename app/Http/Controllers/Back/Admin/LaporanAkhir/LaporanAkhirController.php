<?php

namespace App\Http\Controllers\Back\Admin\LaporanAkhir;

use App\Http\Controllers\Controller;
use App\Models\LaporanAkhir;
use App\Models\UserKegiatan;
use Illuminate\Http\Request;

class LaporanAkhirController extends Controller
{
    public $title = 'Laporan Akhir';

    public function index(Request $request)
    {
        $kegiatan = UserKegiatan::with(['user', 'kegiatan', 'user.pemohon', 'laporan_akhir'])->get();
        // return $kegiatan;
        if ($request->ajax()) {
            return datatables()->of($kegiatan)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $actionBtn = null;
                    if ($row->laporan_akhir) {
                        $actionBtn = '<a href="' .  route('admin.laporan-akhir.find', $row->id) . '" class="btn btn-primary btn-sm"><i class="ti ti-download"></i></a>';
                    }
                    return $actionBtn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }

        return view('pages.back.admin.laporan-akhir.index', [
            'title' => 'Daftar ' . $this->title
        ]);
    }

    public function find($id)
    {
        $laporanAkhir = LaporanAkhir::whereHas('userKegiatan', function ($query) use ($id) {
            $query->where('user_kegiatan_id', $id);
        })->first();
        return redirect()->away($laporanAkhir->getFirstMediaUrl('laporan_akhir'));
    }
}
