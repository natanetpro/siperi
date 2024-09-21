<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('nama', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->hasRole('Administrator') && Auth::user()->email_verified_at) {
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard.index');
            } elseif (Auth::user()->hasRole('Pembimbing') && Auth::user()->email_verified_at) {
                $request->session()->regenerate();
                return redirect()->route('pembimbing.dashboard.index');
            } elseif (Auth::user()->hasRole('Pemohon') && Auth::user()->email_verified_at) {
                $request->session()->regenerate();
                return redirect()->route('peserta.dashboard.index');
            } else {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('login')->with('error', 'Akun belum diverifikasi');
            }
        }
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('error', 'Nama atau password salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
