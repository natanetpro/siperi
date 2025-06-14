<?php

namespace App\Http\Controllers\Back\Peserta\LaporanAkhir;

use App\Http\Controllers\Controller;
use App\Models\LaporanAkhir;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LaporanAkhirController extends Controller
{
    public function __construct()
    {
        // jika tanggal sekarang sudah melewati tanggal selesai kegiatan maka ubah active menjadi false
        $kegiatan = Auth::user()->userKegiatan;
        if ($kegiatan->kegiatan->tanggal_selesai < date('Y-m-d')) {
            $kegiatan->update([
                'active' => false,
            ]);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laporanAkhir = LaporanAkhir::whereHas('userKegiatan', function ($query) {
            $query->where('user_id', auth()->id());
        })->first();
        return view('pages.back.peserta.laporan-akhir.index', compact('laporanAkhir'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'laporan_akhir' => 'required|mimes:pdf|max:2048',
        ]);
        DB::beginTransaction();
        try {
            $laporanAkhir = LaporanAkhir::create([
                'user_kegiatan_id' => auth()->user()->userKegiatan->id,
            ])->addMediaFromRequest('laporan_akhir')->toMediaCollection('laporan_akhir');
            DB::commit();
            return redirect()->route('peserta.laporan-akhir.index')->with('success', 'Laporan akhir berhasil diunggah');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('peserta.laporan-akhir.index')->with('error', 'Laporan akhir gagal diunggah');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(LaporanAkhir $laporanAkhir)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LaporanAkhir $laporanAkhir) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
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
            $laporanAkhir->update([
                'approval_pembimbing' => 'Menunggu',
            ]);
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaporanAkhir $laporanAkhir)
    {
        //
    }
}
