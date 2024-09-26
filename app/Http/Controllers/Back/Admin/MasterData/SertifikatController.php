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
        $certificate = Certificate::first();
        return view('pages.back.admin.master-data.sertifikat.index', ['title' => $this->title, 'certificate' => $certificate]);
    }

    public function createOrUpdate(Request $request)
    {
        $request->validate([
            'nama_pemimpin' => 'required',
            'nip_pemimpin' => 'required|numeric',
            'jabatan_pemimpin' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $certificate = Certificate::first();
            if ($certificate) {
                $certificate->update([
                    'nama_pemimpin' => $request->nama_pemimpin,
                    'nip_pemimpin' => $request->nip_pemimpin,
                    'jabatan_pemimpin' => $request->jabatan_pemimpin,
                ]);
            } else {
                $certificate = Certificate::create([
                    'nama_pemimpin' => $request->nama_pemimpin,
                    'nip_pemimpin' => $request->nip_pemimpin,
                    'jabatan_pemimpin' => $request->jabatan_pemimpin,
                ]);
            }
            DB::commit();
            return redirect()->route('admin.master-data.sertifikat.index')->with('success', 'Data berhasil disimpan');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.master-data.sertifikat.index')->with('error', $e->getMessage());
        }
    }
}
