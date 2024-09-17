<?php

namespace App\Http\Controllers\Back\Peserta\Kegiatan;

use App\Http\Controllers\Controller;
use App\Models\LaporanAkhir;
use App\Models\Logbook;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KegiatanController extends Controller
{
    public function index()
    {
        return view('pages.back.peserta.kegiatan.index', [
            'logbooks' => Logbook::with(['userKegiatan', 'userKegiatan.kegiatan', 'userKegiatan.user'])->whereHas('userKegiatan', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })->get(),
            'laporan_akhir' => LaporanAkhir::with(['userKegiatan', 'userKegiatan.kegiatan', 'userKegiatan.user', 'media'])->whereHas('userKegiatan', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })->first(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'aktivitas' => 'required',
            'dokumentasi' => 'required',
        ]);

        DB::beginTransaction();
        try {
            Logbook::create([
                'user_kegiatan_id' => Auth::user()->userKegiatan->id,
                'tanggal' => $request->tanggal,
                'aktivitas' => $request->aktivitas,
                'dokumentasi' => $request->dokumentasi,
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Logbook berhasil ditambahkan');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function find($id)
    {
        $logbook = Logbook::find($id);
        if (!$logbook) {
            return response()->json([
                'status' => 'error',
                'message' => 'Logbook tidak ditemukan',
            ], 404);
        }
        return response()->json([
            'logbook' => $logbook,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'aktivitas' => 'required',
            'dokumentasi' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $logbook = Logbook::find($id);
            if (!$logbook) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Logbook tidak ditemukan',
                ], 404);
            }

            $logbook->update([
                'tanggal' => $request->tanggal,
                'aktivitas' => $request->aktivitas,
                'dokumentasi' => $request->dokumentasi,
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Logbook berhasil diubah');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function storeLaporanAkhir(Request $request)
    {
        $request->validate([
            'laporan_akhir' => 'required|file|mimes:pdf|max:5000',
        ]);

        DB::beginTransaction();
        try {
            $laporanAkhir = LaporanAkhir::create([
                'user_kegiatan_id' => Auth::user()->userKegiatan->id,
            ])->addMediaFromRequest('laporan_akhir')->toMediaCollection('laporan_akhir');

            DB::commit();

            return redirect()->back()->with('success', 'Laporan akhir berhasil ditambahkan');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function updateLaporanAkhir(Request $request, $id)
    {
        $request->validate([
            'laporan_akhir' => 'required|file|mimes:pdf|max:5000',
        ]);

        DB::beginTransaction();
        try {
            $laporanAkhir = LaporanAkhir::find($id);
            if (!$laporanAkhir) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Laporan akhir tidak ditemukan',
                ], 404);
            }
            // clear media
            $laporanAkhir->clearMediaCollection('laporan_akhir');
            // add new media
            $laporanAkhir->addMediaFromRequest('laporan_akhir')->toMediaCollection('laporan_akhir');

            DB::commit();

            return redirect()->back()->with('success', 'Laporan akhir berhasil diubah');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
