<?php

namespace App\Http\Controllers\Back\Admin\MasterData;

use App\Http\Controllers\Controller;
use App\Mail\ApprovalPengurusMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OperatorController extends Controller
{
    public $modul = 'Operator';
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $operator = User::role('Operator')->get();
            return datatables()->of($operator)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $actionBtn = '<a href="' . route('admin.master-data.operator.edit', $row->id) . '" class="btn btn-warning btn-sm"><i class="ti ti-pencil"></i></a> <button type="button" class="btn btn-danger btn-sm" onclick="deleteOperator(' . $row->id . ')"><i class="ti ti-trash"></i></a></button>';
                    return $actionBtn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('pages.back.admin.master-data.operator.index', [
            'title' => "Daftar " . $this->modul,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.back.admin.master-data.operator.create', [
            'title' => "Tambah " . $this->modul,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'no_telp' => 'required|numeric|unique:users,no_telp',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        DB::beginTransaction();
        try {
            $operator = User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'no_telp' => $request->no_telp,
                'password' => bcrypt($request->password),
                'pemohon_id' => null,
            ]);
            $operator->assignRole(['Administrator', 'Operator']);
            Mail::to($request->email)->send(new ApprovalPengurusMail($request->nama, $request->password, 'Operator'));

            DB::commit();
            return redirect()->route('admin.master-data.operator.index')->with('success', 'Data ' . $this->modul . ' berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $operator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $operator)
    {
        return view('pages.back.admin.master-data.operator.edit', [
            'title' => "Edit " . $this->modul,
            'operator' => $operator,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $operator)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'no_telp' => 'required|numeric|unique:users,no_telp,' . $operator->id,
            'email' => 'required|email|unique:users,email,' . $operator->id,
            'password' => 'nullable|min:8',
        ]);

        DB::beginTransaction();
        try {
            $operator->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'no_telp' => $request->no_telp,
            ]);
            if ($request->password) {
                $operator->update([
                    'password' => bcrypt($request->password),
                ]);
            }
            DB::commit();
            // Mail::to($request->email)->queue(new ApprovalPengurusMail($request->nama, $request->password, 'Operator'));
            return redirect()->route('admin.master-data.operator.index')->with('success', 'Data ' . $this->modul . ' berhasil diubah');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $operator)
    {
        DB::beginTransaction();
        try {
            $operator->delete();
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Data ' . $this->modul . ' berhasil dihapus']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
