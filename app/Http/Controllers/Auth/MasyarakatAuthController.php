<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Masyarakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class MasyarakatAuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.masyarakat.login');
    }

    public function showRegister()
    {
        return view('auth.masyarakat.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:masyarakat,email',
            'password' => 'required|min:6|confirmed',
            'address' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
        ]);

        $masyarakat = Masyarakat::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'no_hp' => $request->no_hp,
        ]);

        Auth::guard('masyarakat')->login($masyarakat);

        $request->session()->regenerate();

        return redirect()->route('masyarakat.dashboard');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('masyarakat')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('masyarakat.dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('masyarakat')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('masyarakat.login');
    }
}