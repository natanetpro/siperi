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
        // return $certificate;
        if ($request->ajax()) {
            return datatables()->of($certificate)
                ->addColumn('aksi', function ($data) {
                    $button = '<a href="' . route('admin.master-data.sertifikat.edit', $data->id) . '" type="button" name="edit" id="' . $data->id . '" class="edit btn btn-warning btn-sm"><i class="ti ti-pencil"></i></a>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" onclick="deleteSertifikat(' . $data->id . ')" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="ti ti-trash"></i></button>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }

        return view('pages.back.admin.master-data.sertifikat.index', ['title' => $this->title, 'certificate' => $certificate]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.back.admin.master-data.sertifikat.create', ['title' => $this->title]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pemimpin' => 'required',
            'nip_pemimpin' => 'required',
            'ttd_pemimpin' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'template' => 'required|file|mimes:pdf|max:2048',
        ]);

        DB::beginTransaction();
        try {
            $sertifikat = Certificate::create([
                'nama_pemimpin' => $request->nama_pemimpin,
                'nip_pemimpin' => $request->nip_pemimpin,
            ]);
            $sertifikat->addMediaFromRequest('ttd_pemimpin')->toMediaCollection('ttd_pemimpin');
            $sertifikat->addMediaFromRequest('template')->toMediaCollection('template');
            DB::commit();
            return redirect()->route('admin.master-data.sertifikat.index')->with('success', 'Data berhasil disimpan');
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Certificate $sertifikat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Certificate $sertifikat)
    {
        return view('pages.back.admin.master-data.sertifikat.edit', ['title' => $this->title, 'sertifikat' => $sertifikat]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Certificate $sertifikat)
    {
        $request->validate([
            'nama_pemimpin' => 'required',
            'nip_pemimpin' => 'required',
            'ttd_pemimpin' => 'image|mimes:jpeg,png,jpg|max:2048',
            'template' => 'file|mimes:pdf|max:2048',
        ]);

        DB::beginTransaction();
        try {
            $sertifikat->update([
                'nama_pemimpin' => $request->nama_pemimpin,
                'nip_pemimpin' => $request->nip_pemimpin,
            ]);
            if ($request->hasFile('ttd_pemimpin')) {
                $sertifikat->clearMediaCollection('ttd_pemimpin');
                $sertifikat->addMediaFromRequest('ttd_pemimpin')->toMediaCollection('ttd_pemimpin');
            }
            if ($request->hasFile('template')) {
                $sertifikat->clearMediaCollection('template');
                $sertifikat->addMediaFromRequest('template')->toMediaCollection('template');
            }
            DB::commit();
            return redirect()->route('admin.master-data.sertifikat.index')->with('success', 'Data berhasil diubah');
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Certificate $sertifikat)
    {
        DB::beginTransaction();
        try {
            $sertifikat->delete();
            $sertifikat->clearMediaCollection('ttd_pemimpin');
            $sertifikat->clearMediaCollection('template');
            DB::commit();
            return response()->json(['success' => 'Data berhasil dihapus']);
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }
}
