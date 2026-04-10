<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Menampilkan form login
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Menampilkan form register
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Proses login user
     * Validasi email dan password, kemudian check di database
     */
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Coba authenticate user dengan credentials
        if (Auth::attempt($credentials)) {
            // Jika berhasil, generate session baru
            $request->session()->regenerate();
            return redirect()->route('films.index')->with('success', 'Selamat datang, ' . Auth::user()->name . '!');
        }

        // Jika gagal, kembali ke form login dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    /**
     * Proses registrasi user baru
     */
    public function register(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // Hash password sebelum disimpan
        $validated['password'] = Hash::make($validated['password']);

        // Create user baru di database
        $user = User::create($validated);

        // Otomatis login setelah register
        Auth::login($user);

        return redirect()->route('films.index')->with('success', 'Registrasi berhasil! Selamat datang, ' . $user->name . '!');
    }

    /**
     * Logout user
     * Hapus session dan arahkan ke halaman login
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // Hapus semua session data
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah logout. Sampai jumpa!');
    }
}
