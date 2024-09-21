<?php

namespace App\Http\Controllers\Back\Admin\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SertifikatController extends Controller
{
    public $title = 'Sertifikat';
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $certificate = Certificate::with('media')->get();
        return view('pages.back.admin.master-data.sertifikat.index', ['title' => $this->title, 'certificate' => $certificate]);
    }

    public function createSertifMahasiswa()
    {
        return view('pages.back.admin.master-data.sertifikat.create-mahasiswa', ['title' => $this->title]);
    }

    public function storeSertifMahasiswa(Request $request)
    {
        $request->validate([
            'nama_pemimpin' => 'required',
            'jabatan_pemimpin' => 'required',
            'ttd_pemimpin' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'template' => 'required|file|mimes:pdf|max:2048',
        ]);

        DB::beginTransaction();
        try {
            $certificate = Certificate::create([
                'nama_pemimpin' => $request->nama_pemimpin,
                'jabatan_pemimpin' => $request->jabatan_pemimpin,
                'nip_pemimpin' => $request->nip_pemimpin,
                'jenis_sertifikat' => 'Mahasiswa',
            ]);
            $certificate->addMedia($request->ttd_pemimpin)->toMediaCollection('ttd_pemimpin');
            $certificate->addMedia($request->template)->toMediaCollection('template');
            DB::commit();
            return redirect()->route('admin.master-data.sertifikat.index')->with('success', 'Sertifikat berhasil ditambahkan');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function editSertifikatMahasiswa()
    {
        $certificate = Certificate::where('jenis_sertifikat', 'Mahasiswa')->first();
        return view('pages.back.admin.master-data.sertifikat.edit-mahasiswa', ['title' => $this->title, 'certificate' => $certificate]);
    }

    public function updateSertifikatMahasiswa(Request $request)
    {
        $request->validate([
            'nama_pemimpin' => 'required',
            'jabatan_pemimpin' => 'required',
            'ttd_pemimpin' => 'image|mimes:jpeg,png,jpg|max:2048',
            'template' => 'file|mimes:pdf|max:2048',
        ]);

        DB::beginTransaction();
        try {
            $certificate = Certificate::where('jenis_sertifikat', 'Mahasiswa')->first();
            $certificate->update([
                'nama_pemimpin' => $request->nama_pemimpin,
                'jabatan_pemimpin' => $request->jabatan_pemimpin,
                'nip_pemimpin' => $request->nip_pemimpin,
            ]);
            if ($request->hasFile('ttd_pemimpin')) {
                // clear media
                $certificate->clearMediaCollection('ttd_pemimpin');
                $certificate->addMedia($request->ttd_pemimpin)->toMediaCollection('ttd_pemimpin');
            }
            if ($request->hasFile('template')) {
                // clear media
                $certificate->clearMediaCollection('template');
                $certificate->addMedia($request->template)->toMediaCollection('template');
            }
            DB::commit();
            return redirect()->route('admin.master-data.sertifikat.index')->with('success', 'Sertifikat berhasil diubah');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    function createSertifSiswa()
    {
        return view('pages.back.admin.master-data.sertifikat.create-siswa', ['title' => $this->title]);
    }

    function storeSertifSiswa(Request $request)
    {
        $request->validate([
            'nama_pemimpin' => 'required',
            'jabatan_pemimpin' => 'required',
            'ttd_pemimpin' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'template' => 'required|file|mimes:pdf|max:2048',
        ]);

        DB::beginTransaction();
        try {
            $certificate = Certificate::create([
                'nama_pemimpin' => $request->nama_pemimpin,
                'jabatan_pemimpin' => $request->jabatan_pemimpin,
                'nip_pemimpin' => $request->nip_pemimpin,
                'jenis_sertifikat' => 'Siswa',
            ]);
            $certificate->addMedia($request->ttd_pemimpin)->toMediaCollection('ttd_pemimpin');
            $certificate->addMedia($request->template)->toMediaCollection('template');
            DB::commit();
            return redirect()->route('admin.master-data.sertifikat.index')->with('success', 'Sertifikat berhasil ditambahkan');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    function editSertifSiswa()
    {
        $certificate = Certificate::where('jenis_sertifikat', 'Siswa')->first();
        return view('pages.back.admin.master-data.sertifikat.edit-siswa', ['title' => $this->title, 'certificate' => $certificate]);
    }

    function updateSertifSiswa(Request $request)
    {
        $request->validate([
            'nama_pemimpin' => 'required',
            'jabatan_pemimpin' => 'required',
            'ttd_pemimpin' => 'image|mimes:jpeg,png,jpg|max:2048',
            'template' => 'file|mimes:pdf|max:2048',
        ]);

        DB::beginTransaction();
        try {
            $certificate = Certificate::where('jenis_sertifikat', 'Siswa')->first();
            $certificate->update([
                'nama_pemimpin' => $request->nama_pemimpin,
                'jabatan_pemimpin' => $request->jabatan_pemimpin,
                'nip_pemimpin' => $request->nip_pemimpin,
            ]);
            if ($request->hasFile('ttd_pemimpin')) {
                // clear media
                $certificate->clearMediaCollection('ttd_pemimpin');
                $certificate->addMedia($request->ttd_pemimpin)->toMediaCollection('ttd_pemimpin');
            }
            if ($request->hasFile('template')) {
                // clear media
                $certificate->clearMediaCollection('template');
                $certificate->addMedia($request->template)->toMediaCollection('template');
            }
            DB::commit();
            return redirect()->route('admin.master-data.sertifikat.index')->with('success', 'Sertifikat berhasil diubah');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
