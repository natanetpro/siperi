<?php

namespace App\Http\Controllers\Back\Admin\Sertifikat;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\UserKegiatan;
use Carbon\Carbon;
use GDText\Box;
use GDText\Color;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SertifikatController extends Controller
{
    public $title = 'Sertifikat';
    public function index(Request $request)
    {
        $userKegiatan = UserKegiatan::with(['user', 'kegiatan', 'user.pemohon', 'laporan_akhir'])->get();
        // return $kegiatan;
        if ($request->ajax()) {
            return datatables()->of($userKegiatan)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $actionBtn = '<a href="' . route('admin.sertifikat.find', $row->id) . '" class="btn btn-primary btn-sm"><i class="ti ti-download"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }

        return view('pages.back.admin.sertifikat.index', [
            'title' => 'Daftar ' . $this->title
        ]);
    }

    public function downloadCertificate($id)
    {
        $userKegiatan = UserKegiatan::find($id);
        $certificateData = Certificate::first();
        // get certificate based on jenis_kegiatan
        $certificate = null;
        if ($userKegiatan->kegiatan->jenis_kegiatan === 'Riset') {
            $certificate = asset('sertifikat-riset.png');
            // dd($certificate);
            $im = imagecreatefrompng($certificate);

            // edit Image
            $box = new Box($im);
            list($width, $height) = getimagesize($certificate);
            // set name
            $box->setFontFace(public_path('fonts/Poppins/Poppins-Bold.ttf'));
            $box->setFontSize(110);
            $box->setFontColor(new Color(0, 0, 0));
            $box->setBox(1150, 1100, 500, 500);
            $box->setTextAlign('center', 'center');
            $box->draw($userKegiatan->user->pemohon->nama_pemohon);


            // set detail
            $box->setFontFace(public_path('fonts/Poppins/Poppins-Regular.ttf'));
            $box->setFontSize(55);
            $box->setFontColor(new Color(0, 0, 0));
            $box->setBox(1330, 1320, 500, 500);
            $box->setTextAlign('left', 'center');
            $box->draw($userKegiatan->user->pemohon->detailPemohonKuliah->nim);

            $box->setFontFace(public_path('fonts/Poppins/Poppins-Regular.ttf'));
            $box->setFontSize(55);
            $box->setFontColor(new Color(0, 0, 0));
            $box->setBox(1325, 1150, 1000, 1000);
            $box->setTextAlign('left', 'center');
            $box->draw($userKegiatan->user->pemohon->tempat_lahir . '/' . Carbon::parse($userKegiatan->user->pemohon->tanggal_lahir)->format('d F Y'));

            $box->setFontFace(public_path('fonts/Poppins/Poppins-Regular.ttf'));
            $box->setFontSize(55);
            $box->setFontColor(new Color(0, 0, 0));
            $box->setBox(1325, 1230, 1000, 1000);
            $box->setTextAlign('left', 'center');
            $box->draw($userKegiatan->user->pemohon->detailPemohonKuliah->prodi);

            $box->setFontFace(public_path('fonts/Poppins/Poppins-Regular.ttf'));
            $box->setFontSize(55);
            $box->setFontColor(new Color(0, 0, 0));
            $box->setBox(1320, 1305, 1000, 1000);
            $box->setTextAlign('left', 'center');
            $box->draw($userKegiatan->user->pemohon->detailPemohonKuliah->fakultas);

            $box->setFontFace(public_path('fonts/Poppins/Poppins-Regular.ttf'));
            $box->setFontSize(55);
            $box->setFontColor(new Color(0, 0, 0));
            $box->setBox(1320, 1490, 800, 800);
            $box->setTextAlign('left', 'center');
            $box->draw($userKegiatan->user->pemohon->detailPemohonKuliah->universitas);

            $box->setFontFace(public_path('fonts/Poppins/Poppins-Regular.ttf'));
            $box->setFontSize(50);
            $box->setFontColor(new Color(0, 0, 0));
            $box->setBox(650, 770, 3000, 3000);
            $box->setTextAlign('left', 'center');
            $box->draw("Sejak " . Carbon::parse($userKegiatan->kegiatan->tanggal_mulai)->format('d F Y') . " sampai dengan tanggal " . Carbon::parse($userKegiatan->kegiatan->tanggal_selesai)->format('d F Y'));

            $box->setFontFace(public_path('fonts/Poppins/Poppins-Regular.ttf'));
            $box->setFontSize(55);
            $box->setFontColor(new Color(0, 0, 0));
            $box->setBox(1450, 1902, 1000, 1000);
            $box->setTextAlign('left', 'center');
            $box->draw(strtoupper($userKegiatan->hasil) ?? 'Belum ada');

            $box->setFontFace(public_path('fonts/Poppins/Poppins-Regular.ttf'));
            $box->setFontSize(55);
            $box->setFontColor(new Color(0, 0, 0));
            $box->setBox(1250, 2460, 1000, 1000);
            $box->setTextAlign('left', 'center');
            $box->draw(Carbon::now()->format('d F Y'));

            $box->setFontFace(public_path('fonts/Poppins/Poppins-Regular.ttf'));
            $box->setFontSize(55);
            $box->setFontColor(new Color(0, 0, 0));
            $box->setBox(1290, 2550, 1000, 1000);
            $box->setTextAlign('left', 'center');
            $box->draw($certificateData->jabatan_pemimpin);

            // $box->setFontFace(public_path('fonts/Poppins/Poppins-Regular.ttf'));
            // $box->setFontSize(55);
            // $box->setFontColor(new Color(0, 0, 0));
            // $box->setBox(1290, 2760, 1000, 1000);
            // $box->setTextAlign('left', 'center');
            // $box->draw($certificateData->nama_pemimpin);

            $box->setFontFace(public_path('fonts/Poppins/Poppins-Regular.ttf'));
            $box->setFontSize(55);
            $box->setFontColor(new Color(0, 0, 0));
            $box->setBox(1290, 3000, 1000, 1000);
            $box->setTextAlign('left', 'center');
            $box->draw($certificateData->nama_pemimpin);

            $qrCodeImage = QrCode::format('png')->size(60)->generate($certificateData->ttd_pemimpin);

            // Simpan QR Code ke dalam file sementara
            $qrCodePath = public_path('qrcode.png');
            file_put_contents($qrCodePath, $qrCodeImage);

            // Buat gambar QR Code dari file sementara
            $qrCode = imagecreatefrompng($qrCodePath);

            // Dapatkan ukuran gambar QR Code
            list($qrWidth, $qrHeight) = getimagesize($qrCodePath);

            // Tentukan posisi QR Code pada sertifikat
            $qrX = 420;  // Sesuaikan posisi X
            $qrY = 990; // Sesuaikan posisi Y

            // Gabungkan gambar QR Code ke gambar sertifikat
            imagecopy($im, $qrCode, $qrX, $qrY, 0, 0, $qrWidth, $qrHeight);

            // Hapus file sementara QR Code
            unlink($qrCodePath);

            // Output image
            header('Content-Type: image/png');
            imagepng($im);
            imagedestroy($im);
            imagedestroy($qrCode);
        }
    }
}
