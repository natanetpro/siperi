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
    public $title = 'Daftar Panel';
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $panel = Panel::all();
            return datatables()->of($panel)
                ->addColumn('aksi', function ($data) {
                    $button = '<a href="' . route('admin.setelan.menu.modul.index', $data->id) . '" type="button" name="show" id="' . $data->id . '" class="btn btn-primary btn-sm"><i class="ti ti-eye"></i></a>';
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

    public function index_modul(Panel $panel, Request $request)
    {
        if ($request->ajax()) {
            $moduls = Menu::wherePanelId($panel->id)->with('children')->get();
            /**
             * format modul:
             * [
             *  {
             *      id: 1,
             *     nama_menu: 'Dashboard',
             *    parent: null,
             *  url: '/admin/dashboard',
             * children: [],
             *
             *  },
             * {
             *    id: 2,
             *   nama_menu: 'Master Data',
             * parent: null,
             * url: '#',
             * children: [
             * {
             *   id: 3,
             * nama_menu: 'Pembimbing',
             * parent: 2,
             * url: '/admin/master-data/pembimbing',
             * 
             * }
             * ]
             * bua
             */

            return datatables()->of($moduls)
                ->addColumn('aksi', function ($data) {
                    $button = '<a href="' . route('admin.setelan.menu.modul.edit', $data->id) . '" name="edit" id="' . $data->id . '" class="edit btn btn-warning btn-sm"><i class="ti ti-pencil"></i></a>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button onclick="deleteModul(' . $data->id . ')" type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="ti ti-trash"></i></button>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('pages.back.admin.setelan.menu.modul.index', [
            'title' => "Daftar Menu",
            'panel' => $panel
        ]);
    }

    public function create_modul(Request $request, Panel $panel)
    {
        return view('pages.back.admin.setelan.menu.modul.create', [
            'title' => "Daftar Menu",
            'panel' => $panel,
            'menus' => Menu::wherePanelId($panel->id)->get(),
            'roles' => Role::all()
        ]);
    }

    public function store_modul(Request $request, Panel $panel)
    {
        $request->validate([
            'nama_menu' => 'required',
            'parent' => 'nullable|exists:menus,id',
            'url'
        ]);

        DB::beginTransaction();
        try {
            $menu = Menu::create([
                'panel_id' => $panel->id,
                'parent' => $request->parent ?? null,
                'nama_menu' => $request->nama_menu,
                'url' => $request->url ?? '#',
            ]);
            DB::commit();
            return redirect()->route('admin.setelan.menu.modul.index', $panel->id)->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit_modul(Panel $panel, Menu $modul)
    {
        return view('pages.back.admin.setelan.menu.modul.edit', [
            'title' => $this->title,
            'modul' => $modul,
            'menus' => Menu::wherePanelId($modul->panel->id)->get(),
            'roles' => Role::all()
        ]);
    }

    public function update_modul(Request $request, Panel $panel, Menu $modul)
    {
        $request->validate([
            'nama_menu' => 'required',
            'parent' => 'nullable|exists:menus,id',
            'url' => 'nullable'
        ]);

        DB::beginTransaction();
        try {
            if ($modul->id == $request->parent) {
                throw new \Exception('Menu tidak boleh memiliki parent dirinya sendiri.');
            }
            $modul->update([
                'parent' => $request->parent ?? null,
                'nama_menu' => $request->nama_menu,
                'url' => $request->url ?? '#',
            ]);
            DB::commit();
            return redirect()->route('admin.setelan.menu.modul.index', $modul->panel_id)->with('success', 'Data berhasil diupdate.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy_modul(Panel $panel, Menu $modul)
    {
        DB::beginTransaction();
        try {
            $modul->delete();
            DB::commit();
            return response()->json(['success' => 'Data berhasil dihapus.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
