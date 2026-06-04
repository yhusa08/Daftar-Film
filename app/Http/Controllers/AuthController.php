<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;

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

    /**
     * Menampilkan form lupa password
     */
    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    /**
     * Proses pengiriman link reset password
     */
    public function sendResetLink(Request $request)
    {
        // Validasi email
        $validated = $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'Email tidak ditemukan atau belum terdaftar di aplikasi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Email harus berformat yang valid.',
        ]);

        // Hapus token lama jika ada
        DB::table('password_reset_tokens')->where('email', $validated['email'])->delete();

        // Generate token
        $token = Str::random(60);

        // Simpan token ke database
        DB::table('password_reset_tokens')->insert([
            'email' => $validated['email'],
            'token' => $token,
            'created_at' => now(),
        ]);

        // URL reset password
        $resetUrl = route('password.reset', ['token' => $token, 'email' => $validated['email']]);

        $smtpUsername = config('mail.mailers.smtp.username');
        $smtpPassword = config('mail.mailers.smtp.password');
        $smtpHost = config('mail.mailers.smtp.host');

        if (empty($smtpUsername) || empty($smtpPassword) || empty($smtpHost)) {
            return back()->withErrors(['email' => 'Konfigurasi SMTP belum lengkap. Periksa MAIL_HOST, MAIL_USERNAME, dan MAIL_PASSWORD di .env.']);
        }

        try {
            Mail::to($validated['email'])->send(new ResetPasswordMail($resetUrl));

            if (count(Mail::failures()) > 0) {
                throw new \Exception('Mail delivery failed.');
            }
        } catch (\Throwable $e) {
            return back()->withErrors(['email' => 'Gagal mengirim email. Periksa konfigurasi mail di .env dan pastikan SMTP valid.']);
        }

        return back()->with('status', 'Link reset password telah dikirim ke email Anda. Cek inbox untuk melanjutkan.');
    }

    /**
     * Menampilkan form reset password
     */
    public function showResetPassword($token)
    {
        // Verifikasi token masih berlaku (24 jam)
        $reset = DB::table('password_reset_tokens')
            ->where('token', $token)
            ->where('created_at', '>', now()->subHours(24))
            ->first();

        if (!$reset) {
            return redirect()->route('auth.login')->withErrors(['token' => 'Token reset password tidak valid atau sudah kadaluarsa.']);
        }

        return view('auth.reset-password', [
            'token' => $token,
            'email' => $reset->email,
        ]);
    }

    /**
     * Proses reset password
     */
    public function resetPassword(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'email' => 'required|email|exists:users,email',
            'token' => 'required',
            'password' => 'required|min:6|confirmed',
        ], [
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
        ]);

        // Verifikasi token
        $reset = DB::table('password_reset_tokens')
            ->where('email', $validated['email'])
            ->where('token', $validated['token'])
            ->where('created_at', '>', now()->subHours(24))
            ->first();

        if (!$reset) {
            return back()->withErrors(['token' => 'Token tidak valid atau sudah kadaluarsa.']);
        }

        // Update password user
        $user = User::where('email', $validated['email'])->first();
        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        // Hapus token setelah digunakan
        DB::table('password_reset_tokens')->where('email', $validated['email'])->delete();

        return redirect()->route('auth.login')->with('success', 'Password berhasil direset! Silakan login dengan password baru Anda.');
    }
}
