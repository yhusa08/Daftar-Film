<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\SeriesController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('home')
        : redirect()->route('auth.login');
});

Route::middleware('auth')->get('/home', function () {
    return view('home');
})->name('home');

// ==================== AUTH ROUTES ====================
// Routes untuk login & register (bisa diakses tanpa login)
Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login.process');

Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.register');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register.process');

// Routes untuk lupa password
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

// Route logout (hanya untuk user yang sudah login)
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout')->middleware('auth');

// ==================== FILM ROUTES ====================
// Routes film hanya bisa diakses jika sudah login
Route::resource('films', FilmController::class)->middleware('auth');

// ==================== GENRE ROUTES ====================
// Routes genre hanya bisa diakses jika sudah login
Route::resource('genres', GenreController::class)->middleware('auth');

// ==================== SERIES ROUTES ====================
// Routes series hanya bisa diakses jika sudah login
Route::resource('series', SeriesController::class)->middleware('auth');
