<?php

namespace App\Http\Controllers\Back\Admin\Setelan;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Panel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class ManajemenMenuController extends Controller
{
    public $title = 'Menu Panel';
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $panel = Panel::all();
            return datatables()->of($panel)
                ->addColumn('aksi', function ($data) {
                    $button = '<button type="button" name="show" id="' . $data->id . '" class="btn btn-primary btn-sm"><i class="ti ti-eye"></i></button>';
                    $button .= '&nbsp;&nbsp;&nbsp<a href="' . route('admin.setelan.menu.panel.edit', $data->id) . '" name="edit" id="' . $data->id . '" class="edit btn btn-warning btn-sm"><i class="ti ti-pencil"></i></a>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button onclick="deletePanel(' . $data->id . ')" type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="ti ti-trash"></i></button>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('pages.back.admin.setelan.menu.panel.index', [
            'title' => $this->title
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.back.admin.setelan.menu.panel.create', [
            'title' => $this->title,
            'roles' => Role::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,name'
        ]);
        DB::beginTransaction();
        try {
            $panel = Panel::create([
                'nama' => $request->nama
            ]);
            $panel->assignRole($request->roles);
            DB::commit();
            return redirect()->route('admin.setelan.menu.panel.index')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.setelan.menu.panel.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Panel $panel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Panel $panel)
    {
        return view('pages.back.admin.setelan.menu.panel.edit', [
            'title' => $this->title,
            'panel' => $panel,
            'roles' => Role::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Panel $panel)
    {
        $request->validate([
            'nama' => 'required',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,name'
        ]);
        DB::beginTransaction();
        try {
            $panel->update([
                'nama' => $request->nama
            ]);
            $panel->syncRoles($request->roles);
            DB::commit();
            return redirect()->route('admin.setelan.menu.panel.index')->with('success', 'Data berhasil diupdate.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.setelan.menu.panel.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Panel $panel)
    {
        DB::beginTransaction();
        try {
            Menu::wherePanelId($panel->id)->delete();
            $panel->delete();
            DB::commit();
            return response()->json(['success' => 'Data berhasil dihapus.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
