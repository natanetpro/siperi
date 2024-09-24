<?php

namespace App\Http\Controllers\Back\Pembimbing\LaporanAkhir;

use App\Http\Controllers\Controller;
use App\Models\LaporanAkhir;
use App\Models\User;
use App\Models\UserKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanAkhirController extends Controller
{
    public $title = 'Laporan Akhir';
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $bimbingan = UserKegiatan::with(['user', 'kegiatan', 'user.pemohon'])->wherePembimbingId(auth()->user()->id)->get();
            return datatables()->of($bimbingan)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('pembimbing.laporan-akhir.show', $row->user->id) . '" class="edit btn btn-primary btn-sm"><i class="ti ti-eye"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.back.pembimbing.laporan-akhir.index', [
            'title' => 'Daftar ' . $this->title
        ]);
    }

    public function show($id)
    {
        $laporan_akhir = LaporanAkhir::with(['userKegiatan', 'userKegiatan.kegiatan', 'userKegiatan.user', 'media'])->whereHas('userKegiatan', function ($query) use ($id) {
            $query->where('user_id', $id);
        })->first();

        return view('pages.back.pembimbing.laporan-akhir.show', [
            'laporan_akhir' => $laporan_akhir,
            'peserta' => User::with(['userKegiatan', 'userKegiatan.kegiatan', 'pemohon'])->find($id),
        ]);
    }

    public function approveLaporanAkhir(Request $request, $id)
    {
        $request->validate([
            'hasil' => 'required|in:Kurang,Cukup,Baik,Sangat Baik'
        ]);
        DB::beginTransaction();
        try {
            $laporan_akhir = LaporanAkhir::find($id);
            $laporan_akhir->update([
                'approval_pembimbing' => 'Disetujui',
                'catatan_pembimbing' => null,
            ]);

            $laporan_akhir->userKegiatan->update([
                'hasil' => $request->hasil
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Laporan Akhir berhasil disetujui');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function rejectLaporanAkhir(Request $request, $id)
    {
        $request->validate([
            'catatan_pembimbing' => 'required'
        ]);
        DB::beginTransaction();
        try {
            $laporan_akhir = LaporanAkhir::find($id);
            $laporan_akhir->update([
                'approval_pembimbing' => 'Ditolak',
                'catatan_pembimbing' => $request->catatan_pembimbing
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Laporan Akhir berhasil ditolak');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
