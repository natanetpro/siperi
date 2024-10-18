<?php

namespace App\Http\Controllers\Back\Admin\MasterData;

use App\Http\Controllers\Controller;
use App\Mail\ApprovalPengurusMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Support\Facades\Mail;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', '!=', 'Pemohon');
        })->get();
        if ($request->ajax()) {
            return datatables()->of($users)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $actionBtn = '<a href="' . route('admin.master-data.pengguna.edit', $row->id) . '" class="btn btn-warning btn-sm"><i class="ti ti-pencil"></i></a>';
                    $actionBtn .= '&nbsp&nbsp<button type="button" onclick="deletePengguna(' . $row->id . ')" class="btn btn-danger btn-sm"><i class="ti ti-trash"></i></button>';
                    return $actionBtn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('pages.back.admin.master-data.pengguna.index', [
            'title' => 'Daftar Pengguna'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::where('name', '!=', 'Pemohon')->get();
        return view('pages.back.admin.master-data.pengguna.create', [
            'title' => 'Tambah Pengguna',
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_asli' => 'required|max:255|unique:users,nama_asli',
            'nama' => 'required|max:255|unique:users,nama',
            'no_telp' => 'required|numeric|unique:users,no_telp',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,name'
        ]);

        DB::beginTransaction();
        try {
            $pengguna = User::create([
                'nama_asli' => $request->nama_asli,
                'nama' => $request->nama,
                'email' => $request->email,
                'no_telp' => $request->no_telp,
                'password' => bcrypt($request->password),
                'email_verified_at' => now(),
                'pemohon_id' => null,
            ]);
            $pengguna->assignRole($request->roles);
            $this->sendWa($request->no_telp, $request->nama, $request->password);
            Mail::to($request->email)->send(new ApprovalPengurusMail($request->nama, $request->password, $request->roles));
            DB::commit();
            return redirect()->route('admin.master-data.pengguna.index')->with('success', 'Data pengguna berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.master-data.pengguna.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $pengguna)
    {
        return view('pages.back.admin.master-data.pengguna.edit', [
            'title' => 'Edit Pengguna',
            'pengguna' => $pengguna,
            'roles' => Role::where('name', '!=', 'Pemohon')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $pengguna)
    {
        $request->validate([
            'nama_asli' => 'required|max:255|unique:users,nama_asli,' . $pengguna->id,
            'nama' => 'required|max:255|unique:users,nama,' . $pengguna->id,
            'no_telp' => 'required|numeric|unique:users,no_telp,' . $pengguna->id,
            'email' => 'required|email|unique:users,email,' . $pengguna->id,
            'password' => 'nullable|min:8',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,name'
        ]);

        DB::beginTransaction();
        try {
            $pengguna = User::find($pengguna->id);
            if ($request->password) {
                $pengguna->update([
                    'nama_asli' => $request->nama_asli,
                    'nama' => $request->nama,
                    'email' => $request->email,
                    'no_telp' => $request->no_telp,
                    'password' => bcrypt($request->password),
                ]);
            } else {
                $pengguna->update([
                    'nama_asli' => $request->nama_asli,
                    'nama' => $request->nama,
                    'email' => $request->email,
                    'no_telp' => $request->no_telp,
                ]);
            }
            $pengguna->syncRoles($request->roles);
            DB::commit();
            return redirect()->route('admin.master-data.pengguna.index')->with('success', 'Data pengguna berhasil diubah.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.master-data.pengguna.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $pengguna)
    {
        DB::beginTransaction();
        try {
            $pengguna = User::find($pengguna->id);
            $pengguna->delete();
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Data pengguna berhasil dihapus.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    private function sendWa($phone, $nama, $password)
    {
        $client = new Client();
        $options = [
            'form_params' => [
                'token' => env('RUANGWA_TOKEN'),
                'number' => $phone,
                'message' => "Berikut akun pengguna anda:\nNama: $nama\nPassword: $password\n\nBy Siperi",
                // format date yyyy-mm-dd
                'date' => date('Y-m-d'),
                // format time hh:mm:ss
                'time' => date('H:i:s'),
            ]
        ];

        $request = new Psr7Request('POST', env('RUANGWA_URL'));
        $res = $client->sendAsync($request, $options)->wait();
        echo $res->getBody();
    }
}
