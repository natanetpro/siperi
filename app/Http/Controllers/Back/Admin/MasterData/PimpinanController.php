<?php

namespace App\Http\Controllers\Back\Admin\MasterData;

use App\Http\Controllers\Controller;
use App\Mail\ApprovalPengurusMail;
use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PimpinanController extends Controller
{
    public $modul = 'Pimpinan';
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $pimpinan = User::role('Pimpinan')->get();
            return datatables()->of($pimpinan)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $actionBtn = '<a href="' . route('admin.master-data.pimpinan.edit', $row->id) . '" class="btn btn-warning btn-sm"><i class="ti ti-pencil"></i></a> <button type="button" class="btn btn-danger btn-sm" onclick="deletePimpinan(' . $row->id . ')"><i class="ti ti-trash"></i></a></button>';
                    return $actionBtn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('pages.back.admin.master-data.pimpinan.index', [
            'title' => "Daftar " . $this->modul,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.back.admin.master-data.pimpinan.create', [
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
            $pimpinan = User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'no_telp' => $request->no_telp,
                'password' => bcrypt($request->password),
            ]);
            $pimpinan->assignRole(['Administrator', 'Pimpinan']);
            $this->sendWa($request->no_telp, $request->nama, $request->password);
            Mail::to($request->email)->send(new ApprovalPengurusMail($request->nama, $request->password, 'Pimpinan'));
            DB::commit();

            return redirect()->route('admin.master-data.pimpinan.index')->with('success', 'Data ' . $this->modul . ' berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $pimpinan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $pimpinan)
    {
        return view('pages.back.admin.master-data.pimpinan.edit', [
            'title' => "Edit " . $this->modul,
            'pimpinan' => $pimpinan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $pimpinan)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'no_telp' => 'required|numeric|unique:users,no_telp,' . $pimpinan->id,
            'email' => 'required|email|unique:users,email,' . $pimpinan->id,
            'password' => 'nullable|min:8',
        ]);

        DB::beginTransaction();
        try {
            $pimpinan->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'no_telp' => $request->no_telp,
            ]);
            if ($request->password) {
                $pimpinan->update([
                    'password' => bcrypt($request->password),
                ]);
            }
            DB::commit();
            // Mail::to($request->email)->queue(new ApprovalPengurusMail($request->nama, $request->password, 'Pimpinan'));
            return redirect()->route('admin.master-data.pimpinan.index')->with('success', 'Data ' . $this->modul . ' berhasil diubah.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $pimpinan)
    {
        DB::beginTransaction();
        try {
            $pimpinan->delete();
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Data ' . $this->modul . ' berhasil dihapus.']);
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
                'message' => "Berikut akun pimpinan anda:\nNama: $nama\nPassword: $password\n\nBy Siperi",
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
