<?php

namespace App\Http\Controllers\Back\Peserta\Kegiatan;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\LaporanAkhir;
use App\Models\Logbook;
use App\Models\UserKegiatan;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use setasign\Fpdi\Fpdi;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
        $data = UserKegiatan::with(['user', 'kegiatan', 'user.pemohon', 'user.pemohon.detailPemohonKuliah', 'user.pemohon.detailPemohonSekolah'])->where('user_id', Auth::user()->id)->first();
        if (!$template) {
            return redirect()->back()->with('error', 'Template sertifikat belum diupload. Silahkan hubungi admin');
        }
        $output = public_path('storage/certificate/certificate.pdf');
        $templatePath = $this->downloadTemplate($template->media[0]->original_url);
        $this->fillPdf($templatePath, $output, $data);
        return response()->download($output);
    }

    private function fillPdf($file, $outputFile, $data)
    {
        $certificate = Auth::user()->pemohon->detailPemohonKuliah ? Certificate::with('media')->whereJenisSertifikat('Mahasiswa')->first() : Certificate::with('media')->whereJenisSertifikat('Siswa')->first();
        $qrcode = QrCode::class;
        $fpdi = new Fpdi();
        $fpdi->setSourceFile($file);
        $template = $fpdi->importPage(1);
        $size = $fpdi->getTemplateSize($template);
        $fpdi->AddPage($size['orientation'], [$size['width'], $size['height']]);
        $fpdi->useTemplate($template);
        // Sesuaikan koordinat dan format data sesuai dengan template Anda
        // different font
        $fpdi->SetFont('Helvetica', '', 32);
        $fpdi->Text(100, 110, $data->user->pemohon->nama_pemohon); // Contoh: Mengisi nama pemohon

        // Contoh mengisi data lainnya:
        $fpdi->SetFont('Arial', '', 12);
        $fpdi->Text(118, 126.3, $data->user->pemohon->detailPemohonKuliah->nim); // Mengisi NIM
        $fpdi->Text(118, 133.3, $data->user->pemohon->tanggal_lahir); // Mengisi tanggal lahir
        $fpdi->Text(118, 140, $data->user->pemohon->detailPemohonKuliah->prodi);
        $fpdi->Text(118, 146.5, $data->user->pemohon->detailPemohonKuliah->fakultas);
        $fpdi->Text(118, 153, $data->user->pemohon->detailPemohonKuliah->universitas);
        $fpdi->Text(121, 181.5, $data->kegiatan->tanggal_mulai);
        $fpdi->Text(121, 188, $data->kegiatan->tanggal_selesai);
        $fpdi->Text(92, 218.5, Carbon::now()->format('d F Y'));
        // // Generate QR code as PNG
        $qrCodePath = storage_path('app/public/qrcode.png');
        QrCode::format('png')->size(200)->generate($certificate->nama_pemimpin . ' ' . $certificate->getFirstMediaUrl('ttd_pemimpin'), $qrCodePath);
        // // Insert QR code image to PDF
        $fpdi->Text(92, 235, $certificate->nama_pemimpin);
        // $fpdi->Text(92, 242, $certificate->getFirstMediaUrl('ttd_pemimpin'));
        $fpdi->Image($qrCodePath, 92, 235, 30, 30); // Sesuaikan posisi dan ukuran QR code di PDF
        $fpdi->Text(92, 249, $certificate->jabatan_pemimpin);
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
