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

    public function daftarRiset(Request $request)
    {
        $request->validate([
            'nama_pemohon' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'email_pemohon' => 'required|email',
            'no_telp_pemohon' => 'required|numeric',
            'tanggal_lahir' => 'required|date',

            'nim' => 'required|numeric',
            'universitas' => 'required',
            'fakultas' => 'required',
            'prodi' => 'required',
            'semester' => 'required|numeric',

            'nama_kegiatan' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'surat_permohonan' => 'required|file|mimes:pdf|max:2048',
        ]);

        DB::beginTransaction();
        try {
            $pemohon = Pemohon::create([
                'nama_pemohon' => $request->nama_pemohon,
                'jenis_kelamin' => $request->jenis_kelamin,
                'email_pemohon' => $request->email_pemohon,
                'no_telp_pemohon' => $request->no_telp_pemohon,
                'tanggal_lahir' => $request->tanggal_lahir,
            ]);

            DetailPemohonKuliah::create([
                'pemohon_id' => $pemohon->id,
                'nim' => $request->nim,
                'universitas' => $request->universitas,
                'fakultas' => $request->fakultas,
                'prodi' => $request->prodi,
                'semester' => $request->semester,
            ]);

            $kegiatan = Kegiatan::create([
                'pemohon_id' => $pemohon->id,
                'jenis_kegiatan' => 'Riset',
                'nama_kegiatan' => $request->nama_kegiatan,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
            ]);

            $kegiatan->addMediaFromRequest('surat_permohonan')->toMediaCollection('riset');

            DB::commit();
            return redirect()->back()->with('success', 'Berhasil mendaftar kegiatan riset. Silahkan tunggu konfirmasi dari admin via email dan whatsapp.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal mendaftar kegiatan riset. Silahkan coba lagi.');
        }
    }

    public function daftarKKP(Request $request)
    {
        $request->validate([
            'nama_pemohon' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'email_pemohon' => 'required|email',
            'no_telp_pemohon' => 'required|numeric',
            'tanggal_lahir' => 'required|date',

            'nim' => 'required|numeric',
            'universitas' => 'required',
            'fakultas' => 'required',
            'prodi' => 'required',
            'semester' => 'required|numeric',

            'nama_kegiatan' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'surat_permohonan' => 'required|file|mimes:pdf|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $pemohon = Pemohon::create([
                'nama_pemohon' => $request->nama_pemohon,
                'jenis_kelamin' => $request->jenis_kelamin,
                'email_pemohon' => $request->email_pemohon,
                'no_telp_pemohon' => $request->no_telp_pemohon,
                'tanggal_lahir' => $request->tanggal_lahir,
            ]);

            DetailPemohonKuliah::create([
                'pemohon_id' => $pemohon->id,
                'nim' => $request->nim,
                'universitas' => $request->universitas,
                'fakultas' => $request->fakultas,
                'prodi' => $request->prodi,
                'semester' => $request->semester,
            ]);

            $kegiatan = Kegiatan::create([
                'pemohon_id' => $pemohon->id,
                'jenis_kegiatan' => 'KKP',
                'nama_kegiatan' => $request->nama_kegiatan,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
            ]);

            $kegiatan->addMediaFromRequest('surat_permohonan')->toMediaCollection('kkp');

            DB::commit();
            return redirect()->back()->with('success', 'Berhasil mendaftar kegiatan KKP. Silahkan tunggu konfirmasi dari admin via email dan whatsapp.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal mendaftar kegiatan KKP. Silahkan coba lagi.');
        }
    }

    public function daftarPrakerin(Request $request)
    {
        $request->validate([
            'nama_pemohon' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'email_pemohon' => 'required|email|unique:pemohons,email_pemohon',
            'no_telp_pemohon' => 'required|numeric',
            'tanggal_lahir' => 'required|date',

            'nis' => 'required|numeric',
            'sekolah' => 'required',
            'kelas' => 'required|numeric',

            'nama_kegiatan' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'surat_permohonan' => 'required|file|mimes:pdf|max:2048',
        ]);

        DB::beginTransaction();
        try {
            $pemohon = Pemohon::create([
                'nama_pemohon' => $request->nama_pemohon,
                'jenis_kelamin' => $request->jenis_kelamin,
                'email_pemohon' => $request->email_pemohon,
                'no_telp_pemohon' => $request->no_telp_pemohon,
                'tanggal_lahir' => $request->tanggal_lahir,
            ]);

            DetailPemohonSekolah::create([
                'pemohon_id' => $pemohon->id,
                'nis' => $request->nis,
                'sekolah' => $request->sekolah,
                'kelas' => $request->kelas,
            ]);

            $kegiatan = Kegiatan::create([
                'pemohon_id' => $pemohon->id,
                'jenis_kegiatan' => 'Prakerin',
                'nama_kegiatan' => $request->nama_kegiatan,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
            ]);

            $kegiatan->addMediaFromRequest('surat_permohonan')->toMediaCollection('prakerin');

            DB::commit();
            return redirect()->back()->with('success', 'Berhasil mendaftar kegiatan Prakerin. Silahkan tunggu konfirmasi dari admin via email dan whatsapp.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal mendaftar kegiatan Prakerin. Silahkan coba lagi.');
        }
    }
}
