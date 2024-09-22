<?php

namespace App\Http\Controllers\Back\Admin\LaporanAkhir;

use App\Http\Controllers\Controller;
use App\Models\UserKegiatan;
use Illuminate\Http\Request;

class LaporanAkhirController extends Controller
{
    public $title = 'Laporan Akhir';

    public function index(Request $request)
    {
        $kegiatan = UserKegiatan::with(['user', 'kegiatan', 'user.pemohon', 'laporan_akhir', 'laporan_akhir'])->get();
        // return $kegiatan;
        if ($request->ajax()) {
            return datatables()->of($kegiatan)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $actionBtn = '<a href="' .  route('admin.laporan-akhir.find', $row->id) . '" class="btn btn-primary btn-sm"><i class="ti ti-eye"></i></a>';
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
        $kegiatan = UserKegiatan::with(['user', 'kegiatan', 'user.pemohon', 'laporan_akhir'])->find($id);
        return view('pages.back.admin.laporan-akhir.show', ['title' => 'Detail ' . $this->title, 'kegiatan' => $kegiatan]);
    }
}
