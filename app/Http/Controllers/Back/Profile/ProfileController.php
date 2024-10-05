<?php

namespace App\Http\Controllers\Back\Profile;

use App\Http\Controllers\Controller;
use App\Models\DetailPemohonKuliah;
use App\Models\DetailPemohonSekolah;
use App\Models\Kegiatan;
use App\Models\Pemohon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index()
    {
        return view('pages.back.profile.index');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        DB::beginTransaction();
        try {
            $user = User::find(Auth::id());
            $user->password = bcrypt($request->password);
            $user->save();

            DB::commit();
            return redirect()->back()->with('success', 'Berhasil mengubah password');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal mengubah password');
        }
    }

    public function updateDataDiri(Request $request)
    {
        $request->validate([
            'nama_pemohon' => 'required|string',
            'email_pemohon' => 'required|email',
            'no_telp_pemohon' => 'required|numeric',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
        ]);

        DB::beginTransaction();
        try {
            $pemohon = Pemohon::whereHas('user', function ($query) {
                $query->where('id', Auth::id());
            })->first();

            $pemohon->nama_pemohon = $request->nama_pemohon;
            $pemohon->email_pemohon = $request->email_pemohon;
            $pemohon->no_telp_pemohon = $request->no_telp_pemohon;
            $pemohon->jenis_kelamin = $request->jenis_kelamin;
            $pemohon->tempat_lahir = $request->tempat_lahir;
            $pemohon->tanggal_lahir = $request->tanggal_lahir;
            $pemohon->save();

            DB::commit();
            return redirect()->back()->with('success', 'Berhasil mengubah data diri');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function updateSekolah(Request $request)
    {
        $request->validate([
            'nis' => 'required|numeric',
            'sekolah' => 'required|string',
            'jurusan' => 'required|in:IPA,IPS',
            'kelas' => 'required|numeric',
        ]);

        DB::beginTransaction();
        try {
            $sekolah = DetailPemohonSekolah::whereHas('pemohon', function ($query) {
                $query->whereHas('user', function ($query) {
                    $query->where('id', Auth::id());
                });
            })->first();

            $sekolah->nis = $request->nis;
            $sekolah->sekolah = strtoupper($request->sekolah);
            $sekolah->jurusan = strtoupper($request->jurusan);
            $sekolah->kelas = $request->kelas;
            $sekolah->save();

            DB::commit();
            return redirect()->back()->with('success', 'Berhasil mengubah data sekolah');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function updateUniversitas(Request $request)
    {
        $request->validate([
            'nim' => 'required|numeric',
            'universitas' => 'required|string',
            'fakultas' => 'required|string',
            'prodi' => 'required|string',
            'semester' => 'required|numeric',
        ]);

        DB::beginTransaction();
        try {
            $universitas = DetailPemohonKuliah::whereHas('pemohon', function ($query) {
                $query->whereHas('user', function ($query) {
                    $query->where('id', Auth::id());
                });
            })->first();

            $universitas->nim = $request->nim;
            $universitas->universitas = strtoupper($request->universitas);
            $universitas->fakultas = strtoupper($request->fakultas);
            $universitas->prodi = strtoupper($request->prodi);
            $universitas->semester = strtoupper($request->semester);
            $universitas->save();

            DB::commit();
            return redirect()->back()->with('success', 'Berhasil mengubah data universitas');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function updateKegiatan(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            $kegiatan = Kegiatan::whereHas('userKegiatans', function ($query) {
                $query->where('user_id', Auth::id());
            })->first();

            $kegiatan->nama_kegiatan = strtoupper($request->nama_kegiatan);
            $kegiatan->save();

            DB::commit();
            return redirect()->back()->with('success', 'Berhasil mengubah data kegiatan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
