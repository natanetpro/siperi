<?php

namespace App\Http\Controllers\Back\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailPemohonKuliah;
use App\Models\DetailPemohonSekolah;
use App\Models\Kegiatan;
use App\Models\Pemohon;
use App\Models\User;
use App\Models\UserKegiatan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengajuanController extends Controller
{
    public $modul = 'Pengajuan';

    public function index(Request $request)
    {
        $jenis_kegiatan = $request->get('jenis_kegiatan') ?? '';
        $approval_admin = $request->get('status') ?? '';
        $pengajuan = Kegiatan::with('pemohon');

        if ($jenis_kegiatan && $approval_admin) {
            $pengajuan->where('jenis_kegiatan', $jenis_kegiatan)
                ->where('approval_admin', $approval_admin);
        } else if ($jenis_kegiatan) {
            $pengajuan->where('jenis_kegiatan', $jenis_kegiatan);
        } else if ($approval_admin) {
            $pengajuan->where('approval_admin', $approval_admin);
        }

        $pengajuan->get();

        if ($request->ajax()) {
            return datatables()->of($pengajuan)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $btn = '<button onclick="openModalPengajuan(' . $row->id . ')" class="edit btn btn-primary btn-sm">View</button>';
                    return $btn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }

        return view('pages.back.admin.pengajuan.index', [
            'title' => 'Daftar ' . $this->modul,
        ]);
    }

    public function find($id)
    {
        $pengajuan = Kegiatan::with(['pemohon', 'pemohon.detailPemohonKuliah', 'pemohon.detailPemohonSekolah', 'media'])->find($id);

        return response()->json($pengajuan);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'approval_admin' => 'required|in:Menunggu,Disetujui,Ditolak',
            'catatan_admin' => 'required_if:approval_admin,Ditolak',
        ]);
        // dd($request->all());
        DB::beginTransaction();
        try {
            $pengajuan = Kegiatan::find($id);
            if ($request->approval_admin === 'Ditolak') {
                $pengajuan->update([
                    'approval_admin' => $request->approval_admin,
                    'catatan_admin' => $request->catatan_admin,
                ]);
            } elseif ($request->approval_admin === 'Disetujui') {
                $pengajuan->update([
                    'approval_admin' => $request->approval_admin,
                ]);

                /**
                 * Buat user baru di table users tetapi dengan format nama berikut:
                 * Riset: 1000x
                 * KKP: 2000x
                 * Prakerin: 3000x
                 * 
                 * setiap data baru yang diapprove maka diincrement 1 semisal data terakhir adalah 10001 maka data baru adalah 10002
                 */

                $firstRiset = 10000;
                $firstKKP = 20000;
                $firstPrakerin = 30000;

                $user = User::query();
                $lastPemohon = $user->role('Pemohon')->latest()->first();
                $new_user = null;
                // dd($lastPemohon);

                // jika belum ada data sama sekali
                if (!$lastPemohon) {
                    if ($pengajuan->jenis_kegiatan === 'Riset') {
                        $new_user = User::create([
                            'nama' => $firstRiset + 1,
                            'email' => $pengajuan->pemohon->email_pemohon,
                            'password' => bcrypt('password'),
                            'no_telp' => $pengajuan->pemohon->no_telp_pemohon,
                        ]);
                    } elseif ($pengajuan->jenis_kegiatan === 'KKP') {
                        $new_user = User::create([
                            'nama' => $firstKKP + 1,
                            'email' => $pengajuan->pemohon->email_pemohon,
                            'password' => bcrypt('password'),
                            'no_telp' => $pengajuan->pemohon->no_telp_pemohon,
                        ]);
                    } elseif ($pengajuan->jenis_kegiatan === 'Prakerin') {
                        $new_user = User::create([
                            'nama' => $firstPrakerin + 1,
                            'email' => $pengajuan->pemohon->email_pemohon,
                            'password' => bcrypt('password'),
                            'no_telp' => $pengajuan->pemohon->no_telp_pemohon,
                        ]);
                    }
                } else {
                    $lastPemohonName = $lastPemohon->name;
                    $lastPemohonName = (int) $lastPemohonName;

                    if ($pengajuan->jenis_kegiatan === 'Riset') {
                        $new_user = User::create([
                            'nama' => $lastPemohonName + 1,
                            'email' => $pengajuan->pemohon->email_pemohon,
                            'password' => bcrypt('password'),
                            'no_telp' => $pengajuan->pemohon->no_telp_pemohon,
                        ]);
                    } elseif ($pengajuan->jenis_kegiatan === 'KKP') {
                        $new_user = User::create([
                            'nama' => $lastPemohonName + 1,
                            'email' => $pengajuan->pemohon->email_pemohon,
                            'password' => bcrypt('password'),
                            'no_telp' => $pengajuan->pemohon->no_telp_pemohon,
                        ]);
                    } elseif ($pengajuan->jenis_kegiatan === 'Prakerin') {
                        $new_user = User::create([
                            'nama' => $lastPemohonName + 1,
                            'email' => $pengajuan->pemohon->email_pemohon,
                            'password' => bcrypt('password'),
                            'no_telp' => $pengajuan->pemohon->no_telp_pemohon,
                        ]);
                    }
                }

                // insert user kegiatan
                UserKegiatan::create([
                    'user_id' => $new_user->id,
                    'kegiatan_id' => $pengajuan->id,
                ]);
            }

            DB::commit();

            return redirect()->back()->with('success', 'Data berhasil diupdate');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
