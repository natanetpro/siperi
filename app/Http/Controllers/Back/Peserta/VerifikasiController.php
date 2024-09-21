<?php

namespace App\Http\Controllers\Back\Peserta;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class VerifikasiController extends Controller
{
    public function verifyAccount($nama)
    {
        $user = User::where('nama', $nama)->first();
        $user->update([
            'email_verified_at' => now(),
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil diverifikasi');
    }
}
