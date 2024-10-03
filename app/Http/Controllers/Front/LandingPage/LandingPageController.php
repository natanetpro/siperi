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
        // dd($request->all());
        $request->validate([
            'nama_pemohon_riset' => 'required',
            'jenis_kelamin_riset' => 'required|in:L,P',
            'email_pemohon_riset' => 'required|email|email:dns',
            'no_telp_pemohon_riset' => 'required|numeric',
            'tempat_lahir_riset' => 'required',
            'tanggal_lahir_riset' => 'required|date',

            'nim_riset' => 'required|numeric',
            'universitas_riset' => 'required',
            'fakultas_riset' => 'required',
            'prodi_riset' => 'required',
            'semester_riset' => 'required|numeric',

            'nama_kegiatan_riset' => 'required',
            'tanggal_mulai_riset' => 'required|date',
            'tanggal_selesai_riset' => 'required|date',
            'surat_permohonan_riset' => 'required|file|mimes:pdf|max:2048',

            // 'captcha_riset' => 'required|captcha',
        ]);

        DB::beginTransaction();
        try {
            // dd(strtotime($request->tanggal_selesai) <= strtotime($request->tanggal_mulai));
            // // jika tanggal mulai kurang dari tanggal sekarang
            if (strtotime($request->tanggal_mulai_riset) < strtotime(date('Y-m-d'))) {
                return response()->json(['error' => 'Tanggal mula kegiatan tidak boleh kurang dari tanggal sekarang.'], 422);
            }
            // jika tanggal selesai kurang dari atau sama dengan tanggal mulai
            if (strtotime($request->tanggal_selesai_riset) <= strtotime($request->tanggal_mulai_riset)) {
                return response()->json(['error' => 'Tanggal selesai kegiatan tidak boleh kurang dari atau sama dengan tanggal mulai.'], 422);
            }
            $pemohon = Pemohon::create([
                'nama_pemohon' => $request->nama_pemohon_riset,
                'jenis_kelamin' => $request->jenis_kelamin_riset,
                'email_pemohon' => $request->email_pemohon_riset,
                'no_telp_pemohon' => $request->no_telp_pemohon_riset,
                'tempat_lahir' => $request->tempat_lahir_riset,
                'tanggal_lahir' => $request->tanggal_lahir_riset,
            ]);

            DetailPemohonKuliah::create([
                'pemohon_id' => $pemohon->id,
                'nim' => $request->nim_riset,
                'universitas' => strtoupper($request->universitas_riset),
                'fakultas' => strtoupper($request->fakultas_riset),
                'prodi' => strtoupper($request->prodi_riset),
                'semester' => $request->semester_riset,
            ]);

            $kegiatan = Kegiatan::create([
                'pemohon_id' => $pemohon->id,
                'jenis_kegiatan' => 'Riset',
                'nama_kegiatan' => strtoupper($request->nama_kegiatan_riset),
                'tanggal_mulai' => $request->tanggal_mulai_riset,
                'tanggal_selesai' => $request->tanggal_selesai_riset,
            ]);

            $kegiatan->addMediaFromRequest('surat_permohonan_riset')->toMediaCollection('riset');

            DB::commit();
            return response()->json(['success' => 'Berhasil mendaftar kegiatan Riset. Silahkan tunggu konfirmasi dari admin via email dan whatsapp.']);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    public function daftarKKP(Request $request)
    {
        $request->validate([
            'nama_pemohon_kkp' => 'required',
            'jenis_kelamin_kkp' => 'required|in:L,P',
            'email_pemohon_kkp' => 'required|email|email:dns',
            'no_telp_pemohon_kkp' => 'required|numeric',
            'tempat_lahir_kkp' => 'required',
            'tanggal_lahir_kkp' => 'required|date',

            'nim_kkp' => 'required|numeric',
            'universitas_kkp' => 'required',
            'fakultas_kkp' => 'required',
            'prodi_kkp' => 'required',
            'semester_kkp' => 'required|numeric',

            'nama_kegiatan_kkp' => 'required',
            'tanggal_mulai_kkp' => 'required|date',
            'tanggal_selesai_kkp' => 'required|date',
            'surat_permohonan_kkp' => 'required|file|mimes:pdf|max:2048',

            // 'captcha_kkp' => 'required|captcha',
        ]);

        DB::beginTransaction();

        try {
            // jika tanggal mulai kurang dari tanggal sekarang
            if (strtotime($request->tanggal_mulai_kkp) < strtotime(date('Y-m-d'))) {
                return redirect()->back()->with('error', 'Tanggal mulai kegiatan tidak boleh kurang dari tanggal sekarang.', 422);
            }
            // jika tanggal selesai kurang dari atau sama dengan tanggal mulai
            if (strtotime($request->tanggal_selesai_kkp) <= strtotime($request->tanggal_mulai_kkp)) {
                return redirect()->back()->with('error', 'Tanggal selesai kegiatan tidak boleh kurang dari atau sama dengan tanggal mulai.', 422);
            }
            $pemohon = Pemohon::create([
                'nama_pemohon' => $request->nama_pemohon_kkp,
                'jenis_kelamin' => $request->jenis_kelamin_kkp,
                'email_pemohon' => $request->email_pemohon_kkp,
                'no_telp_pemohon' => $request->no_telp_pemohon_kkp,
                'tempat_lahir' => $request->tempat_lahir_kkp,
                'tanggal_lahir' => $request->tanggal_lahir_kkp,
            ]);

            DetailPemohonKuliah::create([
                'pemohon_id' => $pemohon->id,
                'nim' => $request->nim_kkp,
                'universitas' => strtoupper($request->universitas_kkp),
                'fakultas' => strtoupper($request->fakultas_kkp),
                'prodi' => strtoupper($request->prodi_kkp),
                'semester' => $request->semester_kkp,
            ]);

            $kegiatan = Kegiatan::create([
                'pemohon_id' => $pemohon->id,
                'jenis_kegiatan' => 'KKP',
                'nama_kegiatan' => strtoupper($request->nama_kegiatan_kkp),
                'tanggal_mulai' => $request->tanggal_mulai_kkp,
                'tanggal_selesai' => $request->tanggal_selesai_kkp,
            ]);

            $kegiatan->addMediaFromRequest('surat_permohonan_kkp')->toMediaCollection('kkp');

            DB::commit();
            return response()->json(['success' => 'Berhasil mendaftar kegiatan KKP. Silahkan tunggu konfirmasi dari admin via email dan whatsapp.']);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    public function daftarPrakerin(Request $request)
    {
        $request->validate([
            'nama_pemohon_prakerin' => 'required',
            'jenis_kelamin_prakerin' => 'required|in:L,P',
            'email_pemohon_prakerin' => 'required|email|email:dns',
            'no_telp_pemohon_prakerin' => 'required|numeric',
            'tempat_lahir_prakerin' => 'required',
            'tanggal_lahir_prakerin' => 'required|date',

            'nis_prakerin' => 'required|numeric',
            'sekolah_prakerin' => 'required',
            'jurusan_prakerin' => 'required',
            'kelas_prakerin' => 'required|numeric',

            'nama_kegiatan_prakerin' => 'required',
            'tanggal_mulai_prakerin' => 'required|date',
            'tanggal_selesai_prakerin' => 'required|date',
            'surat_permohonan_prakerin' => 'required|file|mimes:pdf|max:2048',

            // 'captcha_prakerin' => 'required|captcha',
        ]);

        DB::beginTransaction();
        try {
            // jika tanggal mulai kurang dari tanggal sekarang
            if (strtotime($request->tanggal_mulai_prakerin) < strtotime(date('Y-m-d'))) {
                return redirect()->back()->with('error', 'Tanggal mulai kegiatan tidak boleh kurang dari tanggal sekarang.', 422);
            }
            // jika tanggal selesai kurang dari atau sama dengan tanggal mulai
            if (strtotime($request->tanggal_selesai_prakerin) <= strtotime($request->tanggal_mulai_prakerin)) {
                return redirect()->back()->with('error', 'Tanggal selesai kegiatan tidak boleh kurang dari atau sama dengan tanggal mulai.', 422);
            }
            $pemohon = Pemohon::create([
                'nama_pemohon' => $request->nama_pemohon_prakerin,
                'jenis_kelamin' => $request->jenis_kelamin_prakerin,
                'email_pemohon' => $request->email_pemohon_prakerin,
                'no_telp_pemohon' => $request->no_telp_pemohon_prakerin,
                'tempat_lahir' => $request->tempat_lahir_prakerin,
                'tanggal_lahir' => $request->tanggal_lahir_prakerin,
            ]);

            DetailPemohonSekolah::create([
                'pemohon_id' => $pemohon->id,
                'nis' => $request->nis_prakerin,
                'sekolah' => strtoupper($request->sekolah_prakerin),
                'jurusan' => strtoupper($request->jurusan_prakerin),
                'kelas' => $request->kelas_prakerin,
            ]);

            $kegiatan = Kegiatan::create([
                'pemohon_id' => $pemohon->id,
                'jenis_kegiatan' => 'Prakerin',
                'nama_kegiatan' => strtoupper($request->nama_kegiatan_prakerin),
                'tanggal_mulai' => $request->tanggal_mulai_prakerin,
                'tanggal_selesai' => $request->tanggal_selesai_prakerin,
            ]);

            $kegiatan->addMediaFromRequest('surat_permohonan_prakerin')->toMediaCollection('prakerin');

            DB::commit();
            return response()->json(['success' => 'Berhasil mendaftar kegiatan Prakerin. Silahkan tunggu konfirmasi dari admin via email dan whatsapp.']);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    // public function reloadCaptchaRiset()
    // {
    //     return response()->json(['captcha' => captcha_img()]);
    // }

    // public function reloadCaptchaKKP()
    // {
    //     return response()->json(['captcha' => captcha_img()]);
    // }

    // public function reloadCaptchaPrakerin()
    // {
    //     return response()->json(['captcha' => captcha_img()]);
    // }
}
