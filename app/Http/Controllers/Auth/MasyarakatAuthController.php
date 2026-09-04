<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Masyarakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'address' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
        ]);

        // Cegah email yang sudah terdaftar di tabel masyarakat
        if (Masyarakat::where('email', $validated['email'])->exists()) {
            return back()
                ->withErrors([
                    'email' => 'Email tersebut sudah terdaftar sebagai masyarakat.',
                ])
                ->withInput($request->except('password', 'password_confirmation'));
        }

        $user = DB::transaction(function () use ($validated) {

            // Buat akun utama di users
            $user = User::create([
                'name' => $validated['nama'],
                'email' => $validated['email'],
                'password' => $validated['password'],
                'role' => 'masyarakat',
            ]);

            // Buat profil masyarakat
            Masyarakat::create([
                'user_id' => $user->id,
                'nama' => $validated['nama'],
                'email' => $validated['email'],
                'password' => $user->password,
                'address' => $validated['address'] ?? null,
                'no_hp' => $validated['no_hp'] ?? null,
            ]);

            return $user;
        });

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->route('masyarakat.dashboard');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role !== 'masyarakat') {

                Auth::logout();

                return back()
                    ->withErrors([
                        'email' => 'Akun ini bukan akun masyarakat.',
                    ])
                    ->onlyInput('email');
            }

            return redirect()->route('masyarakat.dashboard');
        }

        return back()
            ->withErrors([
                'email' => 'Email atau password salah.',
            ])
            ->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}