<?php

namespace App\Http\Controllers\Back\Peserta\Logbook;

use App\Http\Controllers\Controller;
use App\Models\Logbook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LogbookController extends Controller
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
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $logbooks = Logbook::whereHas('userKegiatan', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->get();
        return view('pages.back.peserta.logbook.index', compact('logbooks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'aktivitas' => 'required',
        ]);

        DB::beginTransaction();
        try {
            Logbook::create([
                'user_kegiatan_id' => auth()->user()->userKegiatan->id,
                'tanggal' => $request->tanggal,
                'aktivitas' => $request->aktivitas,
            ]);
            DB::commit();
            return redirect()->back()->with('success', 'Logbook berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Logbook gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Logbook $logbook)
    {
        return response()->json($logbook);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Logbook $logbook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Logbook $logbook)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'aktivitas' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $logbook->update([
                'tanggal' => $request->tanggal,
                'aktivitas' => $request->aktivitas,
                'approval_pembimbing' => 'Menunggu',
            ]);
            DB::commit();
            return redirect()->back()->with('success', 'Logbook berhasil diubah');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Logbook gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Logbook $logbook)
    {
        //
    }
}
