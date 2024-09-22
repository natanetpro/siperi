<?php

namespace App\Http\Controllers\Back\Admin\MasterData;

use App\Http\Controllers\Controller;
use App\Mail\ApprovalPengurusMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Routing\RequestContext;

class PembimbingController extends Controller
{
    public $modul = 'Pembimbing';
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $pembimbing = User::role('Pembimbing')->get();
            return datatables()->of($pembimbing)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $actionBtn = '<a href="' . route('admin.master-data.pembimbing.edit', $row->id) . '" class="btn btn-warning btn-sm"><i class="ti ti-pencil"></i></a> <button type="button" class="btn btn-danger btn-sm" onclick="deletePembimbing(' . $row->id . ')"><i class="ti ti-trash"></i></a></button>';
                    return $actionBtn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('pages.back.admin.master-data.pembimbing.index', [
            'title' => "Daftar " . $this->modul,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.back.admin.master-data.pembimbing.create', [
            'title' => "Tambah " . $this->modul,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required|max:255',
            'no_telp' => 'required|numeric|unique:users,no_telp',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        // dd('lolos');

        DB::beginTransaction();
        try {
            $pembimbing = User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'no_telp' => $request->no_telp,
                'password' => bcrypt($request->password),
                'email_verified_at' => now(),
                'pemohon_id' => null,
            ]);
            $pembimbing->assignRole('Pembimbing');
            Mail::to($request->email)->send(new ApprovalPengurusMail($request->nama, $request->password, 'Pembimbing'));
            DB::commit();
            return redirect()->route('admin.master-data.pembimbing.index')->with('success', 'Data ' . $this->modul . ' berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $pembimbing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $pembimbing)
    {
        $pembimbing = User::find($pembimbing->id);
        return view('pages.back.admin.master-data.pembimbing.edit', [
            'title' => "Edit " . $this->modul,
            'pembimbing' => $pembimbing,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $pembimbing)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'no_telp' => 'required|numeric|unique:users,no_telp,' . $pembimbing->id,
            'email' => 'required|email|unique:users,email,' . $pembimbing->id,
            'password' => 'nullable|min:8',
        ]);

        DB::beginTransaction();
        try {
            $pembimbing = User::find($pembimbing->id);
            $pembimbing->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'no_telp' => $request->no_telp,
            ]);
            if ($request->password) {
                $pembimbing->update([
                    'password' => bcrypt($request->password),
                ]);
            }
            DB::commit();
            // Mail::to($request->email)->queue(new ApprovalPengurusMail($request->nama, $request->password, 'Pembimbing'));
            return redirect()->route('admin.master-data.pembimbing.index')->with('success', 'Data ' . $this->modul . ' berhasil diubah.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $pembimbing)
    {
        DB::beginTransaction();
        try {
            $pembimbing = User::find($pembimbing->id);
            $pembimbing->delete();
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Data ' . $this->modul . ' berhasil dihapus.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
