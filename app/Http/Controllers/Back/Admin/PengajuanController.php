<?php

namespace App\Http\Controllers\Back\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    public $modul = 'Pengajuan';

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $pengajuan = Kegiatan::with('pemohon')->get();
            return datatables()->of($pengajuan)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $btn = '';
                    if ($row->approval_admin == 'Menunggu') {
                        $btn = '<a href="javascript:void(0)" class="edit btn btn-warning btn-sm"><i class="ti ti-eye"></i></a>';
                    }
                    $btn = '<button href="javascript:void(0)" class="edit btn btn-primary btn-sm"><i class="ti ti-eye"></i></button>';
                    return $btn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }

        return view('pages.back.admin.pengajuan.index', [
            'title' => 'Daftar ' . $this->modul,
        ]);
    }

    public function search(Request $request)
    {
        $jenis_kegiatan = $request->jenis_kegiatan ?? '';
        $approval_admin = $request->approval_admin ?? '';

        $pengajuan = Kegiatan::with('pemohon')
            ->when($jenis_kegiatan, function ($query, $jenis_kegiatan) {
                return $query->where('jenis_kegiatan', $jenis_kegiatan);
            })
            ->when($approval_admin, function ($query, $approval_admin) {
                return $query->where('approval_admin', $approval_admin);
            })
            ->get();

        return response()->json($pengajuan);
    }
}
