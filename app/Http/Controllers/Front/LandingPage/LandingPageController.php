<?php

namespace App\Http\Controllers\Front\LandingPage;

use App\Http\Controllers\Controller;
use App\Models\DetailPemohonKuliah;
use App\Models\DetailPemohonSekolah;
use App\Models\Kegiatan;
use App\Models\Pemohon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LandingPageController extends Controller
{
    public function index()
    {
        return view('pages.front.landing-page.index');
    }

    public function daftar(Request $request)
    {
        // dd($request->all());
        $request->validate([
            // detail info
            'jenis_kegiatan' => 'required|in:Riset,KKP,Prakerin',
            'nama_pemohon' => 'required',
            'email_pemohon' => 'required',
            'no_telp_pemohon' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date',
            // detail kuliah: ketika RISET & KKP, nim, universitas, fakultas, prodi, semester wajib diisi, untuk nis, sekolah, kelas tidak wajib diisi
            'nim' => 'required_if:jenis_kegiatan,Riset,KKP',
            'universitas' => 'required_if:jenis_kegiatan,Riset,KKP',
            'fakultas' => 'required_if:jenis_kegiatan,Riset,KKP',
            'prodi' => 'required_if:jenis_kegiatan,Riset,KKP',
            'semester' => 'required_if:jenis_kegiatan,Riset,KKP',
            // detail sekolah: ketika PRAKERIN, nis, sekolah, kelas wajib diisi, untuk nim, universitas, fakultas, prodi, semester tidak wajib diisi
            'nis' => 'required_if:jenis_kegiatan,Prakerin',
            'sekolah' => 'required_if:jenis_kegiatan,Prakerin',
            'kelas' => 'required_if:jenis_kegiatan,Prakerin',
            // kegiatan info
            'nama_kegiatan' => 'required|unique:kegiatans,nama_kegiatan',
            'surat_permohonan' => 'required|file|mimes:pdf',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
        ]);
        DB::beginTransaction();
        try {
            $pemohon = Pemohon::create([
                'nama_pemohon' => $request->nama_pemohon,
                'email_pemohon' => $request->email_pemohon,
                'no_telp_pemohon' => $request->no_telp_pemohon,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tanggal_lahir' => $request->tanggal_lahir,
            ]);

            if ($request->jenis_kegiatan === "KKP" || $request->jenis_kegiatan === "Riset") {
                DetailPemohonKuliah::create([
                    'pemohon_id' => $pemohon->id,
                    'nim' => $request->nim,
                    'universitas' => $request->universitas,
                    'fakultas' => $request->fakultas,
                    'prodi' => $request->prodi,
                    'semester' => $request->semester,
                ]);
            } else {
                DetailPemohonSekolah::create([
                    'pemohon_id' => $pemohon->id,
                    'nis' => $request->nis,
                    'sekolah' => $request->sekolah,
                    'kelas' => $request->kelas,
                ]);
            }

            $kegiatan = Kegiatan::create([
                'pemohon_id' => $pemohon->id,
                'jenis_kegiatan' => $request->jenis_kegiatan,
                'nama_kegiatan' => $request->nama_kegiatan,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
            ]);

            if ($request->jenis_kegiatan === "Riset") {
                $kegiatan->addMediaFromRequest('surat_permohonan')->toMediaCollection('riset');
            } elseif ($request->jenis_kegiatan === "KKP") {
                $kegiatan->addMediaFromRequest('surat_permohonan')->toMediaCollection('kkp');
            } else {
                $kegiatan->addMediaFromRequest('surat_permohonan')->toMediaCollection('prakerin');
            }

            DB::commit();
            return redirect()->back()->with('success', 'Data berhasil disimpan, harap tunggu konfirmasi dari admin via email dan whatsapp');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
