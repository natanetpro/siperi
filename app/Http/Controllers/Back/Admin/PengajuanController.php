<?php

namespace App\Http\Controllers\Back\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ApprovalPemohonMail;
use App\Models\DetailPemohonKuliah;
use App\Models\DetailPemohonSekolah;
use App\Models\Kegiatan;
use App\Models\Pemohon;
use App\Models\User;
use App\Models\UserKegiatan;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PengajuanController extends Controller
{
    public $modul = 'Pengajuan';

    public function index(Request $request)
    {
        $jenis_kegiatan = $request->get('jenis_kegiatan') ?? '';
        $approval_admin = $request->get('status') ?? '';
        $pengajuan = Kegiatan::with(['pemohon', 'userKegiatans']);

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
                    $btn = '';
                    $btn .= '<button onclick="openModalPengajuan(' . $row->id . ')" class="edit btn btn-primary btn-sm"><i class="ti ti-eye"></i></button>';
                    if ($row->approval_admin === 'Disetujui') {
                        $kegiatan = UserKegiatan::whereKegiatanId($row->id)->first();
                        if (!$kegiatan->pembimbing_id) {
                            $btn .= '<button onclick="openModalPembimbing(' . $row->id . ')" class="btn btn-success btn-sm mt-sm-2 mt-md-0 ms-sm-0 ms-md-2">Set Pembimbing</button>';
                        }
                    }
                    return $btn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }

        return view('pages.back.admin.pengajuan.index', [
            'title' => 'Daftar ' . $this->modul,
            'pembimbing' => User::role('Pembimbing')->get(),
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
            if ($pengajuan->approval_admin === 'Disetujui' || $pengajuan->approval_admin === 'Ditolak') {
                return redirect()->back()->with('error', 'Data sudah ditinjau');
            }
            if ($request->approval_admin === 'Ditolak') {
                $pengajuan->update([
                    'approval_admin' => $request->approval_admin,
                    'catatan_admin' => $request->catatan_admin,
                ]);

                // send email
                $pemohon = Pemohon::find($pengajuan->pemohon_id);
                $this->sendWa($pemohon, $request->approval_admin, $request->catatan_admin);
                Mail::to($pemohon->email_pemohon)
                    ->send(new ApprovalPemohonMail($pemohon->nama_pemohon, $request->approval_admin, $request->catatan_admin, '', ''));
            } elseif ($request->approval_admin === 'Disetujui') {
                $pengajuan->update([
                    'approval_admin' => $request->approval_admin,
                ]);

                $firstRiset = 10000;
                $firstKKP = 20000;
                $firstPrakerin = 30000;

                // random string
                $password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);

                $user = User::query();
                $lastPemohon = $user->role('Pemohon')->whereHas('userKegiatan', function ($query) use ($pengajuan) {
                    $query->whereHas('kegiatan', function ($query) use ($pengajuan) {
                        $query->where('jenis_kegiatan', $pengajuan->jenis_kegiatan);
                    });
                })->latest()->first();
                $new_user = null;

                if (!$lastPemohon) {
                    if ($pengajuan->jenis_kegiatan === 'Riset') {
                        $new_user = User::create([
                            'nama' => $firstRiset + 1,
                            'email' => $firstRiset + 1 . '@siperi.test',
                            'password' => $password,
                            'no_telp' => $pengajuan->pemohon->no_telp_pemohon,
                            'pemohon_id' => $pengajuan->pemohon->id,
                        ]);
                    } elseif ($pengajuan->jenis_kegiatan === 'KKP') {
                        $new_user = User::create([
                            'nama' => $firstKKP + 1,
                            'email' => $firstKKP + 1 . '@siperi.test',
                            'password' => $password,
                            'no_telp' => $pengajuan->pemohon->no_telp_pemohon,
                            'pemohon_id' => $pengajuan->pemohon->id,
                        ]);
                    } elseif ($pengajuan->jenis_kegiatan === 'Prakerin') {
                        $new_user = User::create([
                            'nama' => $firstPrakerin + 1,
                            'email' => $firstPrakerin + 1 . '@siperi.test',
                            'password' => $password,
                            'no_telp' => $pengajuan->pemohon->no_telp_pemohon,
                            'pemohon_id' => $pengajuan->pemohon->id,
                        ]);
                    }
                } else {
                    $lastPemohonName = $lastPemohon->nama;
                    $lastPemohonName = (int) $lastPemohonName;

                    if ($pengajuan->jenis_kegiatan === 'Riset') {
                        $new_user = User::create([
                            'nama' => $lastPemohonName + 1,
                            'email' => $lastPemohonName + 1 . '@siperi.test',
                            'password' => $password,
                            'no_telp' => $pengajuan->pemohon->no_telp_pemohon,
                            'pemohon_id' => $pengajuan->pemohon->id,
                        ]);
                    } elseif ($pengajuan->jenis_kegiatan === 'KKP') {
                        $new_user = User::create([
                            'nama' => $lastPemohonName + 1,
                            'email' => $lastPemohonName + 1 . '@siperi.test',
                            'password' => $password,
                            'no_telp' => $pengajuan->pemohon->no_telp_pemohon,
                            'pemohon_id' => $pengajuan->pemohon->id,
                        ]);
                    } elseif ($pengajuan->jenis_kegiatan === 'Prakerin') {
                        $new_user = User::create([
                            'nama' => $lastPemohonName + 1,
                            'email' => $lastPemohonName + 1 . '@siperi.test',
                            'password' => $password,
                            'no_telp' => $pengajuan->pemohon->no_telp_pemohon,
                            'pemohon_id' => $pengajuan->pemohon->id,
                        ]);
                    }
                }

                // assign role
                $new_user->assignRole('Pemohon');

                // insert user kegiatan
                UserKegiatan::create([
                    'user_id' => $new_user->id,
                    'kegiatan_id' => $pengajuan->id,
                    'active' => true,
                ]);

                // send email
                $pemohon = Pemohon::find($pengajuan->pemohon_id);
                $message = 'Selamat, permohonan anda telah disetujui. Berikut adalah akun anda:';
                $this->sendWa($pemohon, $request->approval_admin, $message, $new_user->nama, $password);
                Mail::to($pemohon->email_pemohon)
                    ->send(new ApprovalPemohonMail($pemohon->nama_pemohon, $request->approval_admin, $message, $new_user->nama, $password));
            }

            DB::commit();

            return redirect()->back()->with('success', 'Data berhasil diupdate');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function setPembimbing(Request $request, $id)
    {
        $request->validate([
            'pembimbing_id' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $kegiatan = UserKegiatan::whereKegiatanId($id)->first();
            $kegiatan->update([
                'pembimbing_id' => $request->pembimbing_id,
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Data pembimbing berhasil diupdate');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    private function sendWa(Pemohon $pemohon, string $approval, string $message = null, string $nama = null, string $password = null)
    {
        $initMessage = "Halo $pemohon->nama_pemohon,\n";
        if ($approval === 'Ditolak') {
            $initMessage .= "Maaf, permohonan anda ditolak. Alasan: $message";
        } else {
            $initMessage .= "$message.\n";
            $initMessage .= "Nama: $nama\n";
            $initMessage .= "Password: $password\n";

            // footer Siperi
            $initMessage .= "\n\nBy Siperi";
        }

        $client = new Client();
        $options = [
            'form_params' => [
                'token' => env('RUANGWA_TOKEN'),
                'number' => $pemohon->no_telp_pemohon,
                'message' => $initMessage,
                // format date yyyy-mm-dd
                'date' => date('Y-m-d'),
                // format time hh:mm:ss
                'time' => date('H:i:s'),
            ]
        ];

        $request = new Psr7Request('POST', env('RUANGWA_URL'));
        $res = $client->sendAsync($request, $options)->wait();
        echo $res->getBody();
    }
}
