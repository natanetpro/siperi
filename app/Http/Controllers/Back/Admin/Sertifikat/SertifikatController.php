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

        // get certificate based on jenis_kegiatan
        $certificate = null;
        $certificate = $userKegiatan->kegiatan->jenis_kegiatan == 'Riset' ? asset('sertifikat-riset.jpg') : null;
        $im = imagecreatefromjpeg($certificate);

        // edit Image
        $box = new Box($im);

        // set name
        $box->setFontFace(public_path('fonts/Poppins/Poppins-Bold.ttf'));
        $box->setFontSize(30);
        $box->setFontColor(new Color(0, 0, 0));
        $box->setBox(50, 45, 800, 800);
        $box->setTextAlign('center', 'center');
        $box->draw($userKegiatan->user->pemohon->nama_pemohon);


        // set detail
        $box->setFontFace(public_path('fonts/Poppins/Poppins-Regular.ttf'));
        $box->setFontSize(18);
        $box->setFontColor(new Color(0, 0, 0));
        $box->setBox(75, 103, 800, 800);
        $box->setTextAlign('center', 'center');
        $box->draw($userKegiatan->user->pemohon->detailPemohonKuliah->nim);

        $box->setFontFace(public_path('fonts/Poppins/Poppins-Regular.ttf'));
        $box->setFontSize(18);
        $box->setFontColor(new Color(0, 0, 0));
        $box->setBox(110, 130, 800, 800);
        $box->setTextAlign('center', 'center');
        $box->draw(Carbon::parse($userKegiatan->user->pemohon->tanggal_lahir)->format('d F Y'));

        $box->setFontFace(public_path('fonts/Poppins/Poppins-Regular.ttf'));
        $box->setFontSize(18);
        $box->setFontColor(new Color(0, 0, 0));
        $box->setBox(30, 155, 800, 800);
        $box->setTextAlign('center', 'center');
        $box->draw($userKegiatan->user->pemohon->detailPemohonKuliah->prodi);

        $box->setFontFace(public_path('fonts/Poppins/Poppins-Regular.ttf'));
        $box->setFontSize(18);
        $box->setFontColor(new Color(0, 0, 0));
        $box->setBox(40, 178, 800, 800);
        $box->setTextAlign('center', 'center');
        $box->draw($userKegiatan->user->pemohon->detailPemohonKuliah->fakultas);

        $box->setFontFace(public_path('fonts/Poppins/Poppins-Regular.ttf'));
        $box->setFontSize(18);
        $box->setFontColor(new Color(0, 0, 0));
        $box->setBox(58, 204, 800, 800);
        $box->setTextAlign('center', 'center');
        $box->draw($userKegiatan->user->pemohon->detailPemohonKuliah->universitas);

        $box->setFontFace(public_path('fonts/Poppins/Poppins-Regular.ttf'));
        $box->setFontSize(18);
        $box->setFontColor(new Color(0, 0, 0));
        $box->setBox(325, 337, 800, 800);
        $box->setTextAlign('left', 'center');
        $box->draw($userKegiatan->kegiatan->tanggal_mulai);

        $box->setFontFace(public_path('fonts/Poppins/Poppins-Regular.ttf'));
        $box->setFontSize(18);
        $box->setFontColor(new Color(0, 0, 0));
        $box->setBox(560, 337, 800, 800);
        $box->setTextAlign('left', 'center');
        $box->draw($userKegiatan->kegiatan->tanggal_selesai);

        $certifData = Certificate::where('jenis_sertifikat', 'Mahasiswa')->first();
        $box->setFontFace(public_path('fonts/Poppins/Poppins-Regular.ttf'));
        $box->setFontSize(18);
        $box->setFontColor(new Color(0, 0, 0));
        $box->setBox(55, 620, 800, 800);
        $box->setTextAlign('center', 'center');
        $box->draw("Test TTD");
        $box->draw(QrCode::size(200)->format('png')->generate($certifData->nama_pemimpin . " " . $certifData->jabatan_pemimpin));

        header('Content-Type: image/jpg');
        imagejpeg($im);
    }
}
