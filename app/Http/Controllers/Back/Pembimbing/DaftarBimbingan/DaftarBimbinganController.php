<?php

namespace App\Http\Controllers\Back\Pembimbing\DaftarBimbingan;

use App\Http\Controllers\Controller;
use App\Models\LaporanAkhir;
use App\Models\Logbook;
use App\Models\User;
use App\Models\UserKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DaftarBimbinganController extends Controller
{
    public $module = 'Daftar Bimbingan';
    public function index(Request $request)
    {
        // $bimbingan = UserKegiatan::with(['user', 'kegiatan'])->wherePembimbingId(auth()->user()->id)->get();
        // return view('pages.back.pembimbing.bimbingan.index', [
        //     'bimbingan' => $bimbingan,
        //     'title' => $this->module
        // ]);

        if ($request->ajax()) {
            $bimbingan = UserKegiatan::with(['user', 'kegiatan', 'user.pemohon'])->wherePembimbingId(auth()->user()->id)->get();
            return datatables()->of($bimbingan)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('pembimbing.daftar-bimbingan.show', $row->user->id) . '" class="edit btn btn-primary btn-sm"><i class="ti ti-eye"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.back.pembimbing.bimbingan.index', [
            'title' => $this->module
        ]);
    }

    public function show($id)
    {
        $logbook = Logbook::with(['userKegiatan', 'userKegiatan.kegiatan', 'userKegiatan.user'])->whereHas('userKegiatan', function ($query) use ($id) {
            $query->where('user_id', $id);
        })->orderBy('id')->get();

        $laporan_akhir = LaporanAkhir::with(['userKegiatan', 'userKegiatan.kegiatan', 'userKegiatan.user', 'media'])->whereHas('userKegiatan', function ($query) use ($id) {
            $query->where('user_id', $id);
        })->first();

        return view('pages.back.pembimbing.bimbingan.show', [
            'logbooks' => $logbook,
            'laporan_akhir' => $laporan_akhir,
            'peserta' => User::with(['userKegiatan', 'userKegiatan.kegiatan', 'pemohon'])->find($id),
        ]);
    }

    public function approveLogbook($id)
    {
        DB::beginTransaction();
        try {
            $logbook = Logbook::find($id);
            $logbook->update([
                'approval_pembimbing' => 'Disetujui'
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Logbook berhasil disetujui');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function rejectLogbook(Request $request, $id)
    {
        $request->validate([
            'catatan_pembimbing' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $logbook = Logbook::find($id);
            $logbook->update([
                'approval_pembimbing' => 'Ditolak',
                'catatan_pembimbing' => $request->catatan_pembimbing
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Logbook berhasil ditolak');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function approveLaporanAkhir($id)
    {
        DB::beginTransaction();
        try {
            $laporan_akhir = LaporanAkhir::find($id);
            $laporan_akhir->update([
                'approval_pembimbing' => 'Disetujui'
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
