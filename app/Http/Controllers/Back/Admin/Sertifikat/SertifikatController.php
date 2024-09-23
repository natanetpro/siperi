<?php

namespace App\Http\Controllers\Back\Admin\Sertifikat;

use App\Http\Controllers\Controller;
use App\Models\UserKegiatan;
use Illuminate\Http\Request;

class SertifikatController extends Controller
{
    public $title = 'Sertifikat';
    public function index(Request $request)
    {
        $userKegiatan = UserKegiatan::with(['user', 'kegiatan', 'user.pemohon', 'laporan_akhir'])->get();
        // return $kegiatan;
        if ($request->ajax()) {
            return datatables()->of($userKegiatan)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $actionBtn = '<a href="#" class="btn btn-primary btn-sm"><i class="ti ti-download"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }

        return view('pages.back.admin.sertifikat.index', [
            'title' => 'Daftar ' . $this->title
        ]);
    }
}
