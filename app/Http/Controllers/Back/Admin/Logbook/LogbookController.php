<?php

namespace App\Http\Controllers\Back\Admin\Logbook;

use App\Http\Controllers\Controller;
use App\Models\UserKegiatan;
use Illuminate\Http\Request;

class LogbookController extends Controller
{
    public $title = 'Logbook';

    public function index(Request $request)
    {
        $kegiatan = UserKegiatan::with(['user', 'kegiatan', 'user.pemohon', 'logbooks', 'laporan_akhir'])->get();
        // return $kegiatan;
        if ($request->ajax()) {
            return datatables()->of($kegiatan)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $actionBtn = '<a href="' .  route('admin.logbook.find', $row->id) . '" class="btn btn-primary btn-sm"><i class="ti ti-eye"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }

        return view('pages.back.admin.logbook.index', [
            'title' => 'Daftar ' . $this->title
        ]);
    }

    public function find($id)
    {
        $kegiatan = UserKegiatan::with(['user', 'kegiatan', 'user.pemohon', 'logbooks'])->find($id);
        return view('pages.back.admin.logbook.show', ['title' => 'Detail ' . $this->title, 'kegiatan' => $kegiatan]);
    }
}
