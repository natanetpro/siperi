<?php

namespace App\Http\Controllers\Back\Peserta\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('pages.back.peserta.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('nama', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->hasRole('Pemohon')) {
                $request->session()->regenerate();
                return redirect()->route('peserta.dashboard.index');
            }
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('peserta.login.index')->with('error', 'Anda tidak memiliki akses.');
        }
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('peserta.login.index')->with('error', 'Nama atau password salah.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('peserta.login.index');
    }
}
