<?php

namespace App\Http\Controllers\Back\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserKegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public $title = 'Kegiatan';

    public function index(Request $request)
    {
        $kegiatan = UserKegiatan::with(['user', 'kegiatan', 'user.pemohon', 'logbooks', 'laporan_akhir'])->get();
        // return $kegiatan;
        if ($request->ajax()) {
            return datatables()->of($kegiatan)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $actionBtn = '<a href="' .  route('admin.kegiatan.find', $row->id) . '" class="btn btn-primary btn-sm"><i class="ti ti-eye"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('pages.back.admin.kegiatan.index', ['title' => 'Kumpulan ' . $this->title]);
    }

    public function find($id)
    {
        $kegiatan = UserKegiatan::with(['user', 'kegiatan', 'user.pemohon'])->find($id);
        return view('pages.back.admin.kegiatan.show', ['title' => 'Detail ' . $this->title, 'kegiatan' => $kegiatan]);
    }
}
