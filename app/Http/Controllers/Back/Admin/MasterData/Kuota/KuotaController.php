<?php

namespace App\Http\Controllers\Back\Admin\MasterData\Kuota;

use App\Http\Controllers\Controller;
use App\Models\KuotaProgram;
use Illuminate\Http\Request;

class KuotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.back.admin.master-data.kuota.index', [
            'title' => 'Kuota Program',
            'kuotas' => KuotaProgram::all()
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(KuotaProgram $kuotaProgram)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KuotaProgram $kuotum)
    {
        return view('pages.back.admin.master-data.kuota.edit', [
            'title' => 'Edit Kuota Program',
            'kuotum' => $kuotum
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KuotaProgram $kuotum)
    {
        $request->validate([
            'kuota' => 'required|numeric'
        ]);

        $kuotum->update([
            'kuota' => $request->kuota
        ]);

        return redirect()->route('admin.master-data.kuota.index')->with('success', 'Kuota program berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KuotaProgram $kuotaProgram)
    {
        //
    }
}
