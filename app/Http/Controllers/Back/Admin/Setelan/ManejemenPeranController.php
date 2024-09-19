<?php

namespace App\Http\Controllers\Back\Admin\Setelan;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class ManejemenPeranController extends Controller
{
    public $title = 'Manajemen Peran';
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $peran = Role::all();
            return datatables()->of($peran)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $btn = '<a href="' . route('admin.setelan.peran.edit', $row->id) . '" class="edit btn btn-warning btn-sm"><i class="ti ti-pencil"></i></a>';
                    $btn = $btn . ' <button onclick="deletePeran(' . $row->id . ')" class="delete btn btn-danger btn-sm"><i class="ti ti-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('pages.back.admin.setelan.peran.index', [
            'title' => $this->title,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.back.admin.setelan.peran.create', [
            'title' => $this->title,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $peran = Role::create(['name' => $request->name]);
            DB::commit();
            return redirect()->route('admin.setelan.peran.index')->with('success', 'Peran berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.setelan.peran.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $peran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $peran)
    {
        return view('pages.back.admin.setelan.peran.edit', [
            'title' => $this->title,
            'peran' => $peran,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $peran)
    {
        $request->validate([
            'name' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $peran->update(['name' => $request->name]);
            DB::commit();
            return redirect()->route('admin.setelan.peran.index')->with('success', 'Peran berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.setelan.peran.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $peran)
    {
        DB::beginTransaction();
        try {
            $peran->delete();
            DB::commit();
            return response()->json(['success' => 'Peran berhasil dihapus']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
