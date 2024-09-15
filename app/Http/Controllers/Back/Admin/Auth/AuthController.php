<?php

namespace App\Http\Controllers\Back\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('pages.back.admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('nama', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->hasRole('Administrator')) {
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard.index');
            } else {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('admin.login.index')->with('error', 'Anda tidak memiliki akses');
            }
        }
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login.index')->with('error', 'Nama atau password salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login.index');
    }
}
