<?php

namespace App\Http\Controllers\Back\Pembimbing\Logbook;

use App\Http\Controllers\Controller;
use App\Models\Logbook;
use App\Models\User;
use App\Models\UserKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogbookController extends Controller
{
    public $title = 'Logbook';
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $userKegiatan = UserKegiatan::with(['kegiatan', 'user', 'user.pemohon'])->wherePembimbingId(auth()->user()->id)->get();
            return datatables()->of($userKegiatan)
                ->addColumn('aksi', function ($data) {
                    $button = '<a href="' . route('pembimbing.logbook.show', $data->user->id) . '" class="btn btn-primary btn-sm"><i class="ti ti-eye"></i></a>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }

        return view('pages.back.pembimbing.logbook.index', [
            'title' => 'Daftar ' . $this->title
        ]);
    }

    public function show($id)
    {
        $logbook = Logbook::with(['userKegiatan', 'userKegiatan.kegiatan', 'userKegiatan.user'])->whereHas('userKegiatan', function ($query) use ($id) {
            $query->where('user_id', $id);
        })->orderBy('id')->get();

        return view('pages.back.pembimbing.logbook.show', [
            'logbooks' => $logbook,
            'peserta' => User::with(['userKegiatan', 'userKegiatan.kegiatan', 'pemohon'])->find($id),
        ]);
    }

    public function approveLogbook($id)
    {
        DB::beginTransaction();
        try {
            $logbook = Logbook::find($id);
            $logbook->update([
                'approval_pembimbing' => 'Disetujui',
                'catatan_pembimbing' => null
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Logbook berhasil disetujui');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function rejectLogbook(Request $request, $id)
    {
        $request->validate([
            'catatan_pembimbing' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $logbook = Logbook::find($id);
            $logbook->update([
                'approval_pembimbing' => 'Ditolak',
                'catatan_pembimbing' => $request->catatan_pembimbing
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Logbook berhasil ditolak');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
