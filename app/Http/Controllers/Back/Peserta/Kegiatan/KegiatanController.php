<?php

namespace App\Http\Controllers\Back\Peserta\Kegiatan;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\LaporanAkhir;
use App\Models\Logbook;
use App\Models\UserKegiatan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use setasign\Fpdi\Fpdi;

class KegiatanController extends Controller
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
            // check if dokumentasi is a valid url and google drive url
            if (!filter_var($request->dokumentasi, FILTER_VALIDATE_URL) || !preg_match('/drive.google.com/', $request->dokumentasi)) {
                throw new Exception('Dokumentasi harus berupa link google drive');
            }
            if ($request->tanggal < date('Y-m-d')) {
                throw new Exception('Tanggal tidak boleh kurang dari hari ini');
            }
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
            if ($logbook->approval_pembimbing == 'Disetujui') {
                return redirect()->back()->with('error', 'Logbook sudah disetujui');
            }

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
                'approval_pembimbing' => 'Menunggu',
                'catatan_pembimbing' => null,
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
            $laporanAkhir->update([
                'approval_pembimbing' => 'Menunggu',
                'catatan_pembimbing' => null,
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

    public function download_certificate()
    {
        $template = Auth::user()->pemohon->detailPemohonKuliah ? Certificate::with('media')->whereJenisSertifikat('Mahasiswa')->first() : Certificate::with('media')->whereJenisSertifikat('Siswa')->first();
        $data = UserKegiatan::with(['user', 'kegiatan', 'user.pemohon'])->where('user_id', Auth::user()->id)->first();
        if (!$template) {
            return redirect()->back()->with('error', 'Template sertifikat belum diupload. Silahkan hubungi admin');
        }
        $output = public_path('storage/certificate/certificate.pdf');
        $templatePath = $this->downloadTemplate($template->media[1]->original_url);
        $this->fillPdf($templatePath, $output, $data);
        return response()->download($output);
    }

    private function fillPdf($file, $outputFile, $data)
    {
        $fpdi = new Fpdi();
        $fpdi->setSourceFile($file);
        $template = $fpdi->importPage(1);
        $size = $fpdi->getTemplateSize($template);
        $fpdi->AddPage($size['orientation'], [$size['width'], $size['height']]);
        $fpdi->useTemplate($template);
        $fpdi->SetFont('Arial', '', 12);
        $fpdi->Text(100, 100, $data->user->pemohon->nama_pemohon);

        return $fpdi->Output($outputFile, 'F');
    }

    private function downloadTemplate($url)
    {
        $contents = file_get_contents($url);
        $tempPath = storage_path('app/public/temp_template.pdf');
        file_put_contents($tempPath, $contents);

        return $tempPath;
    }
}
