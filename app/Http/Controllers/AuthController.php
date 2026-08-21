<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin() {
        // Cek apakah belum ada URL tujuan yang tersimpan
        if (!session()->has('url.intended')) {
            // Simpan URL halaman sebelumnya (detail kamar) ke dalam memori session
            session(['url.intended' => url()->previous()]);
        }
        
        return view('login');
    }

    // --- REVISI: Fungsi login sekarang menggunakan Username ---
    public function login(Request $request) {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required',
        ], [
            'username.required' => 'Mohon masukkan Username Anda.',
            'password.required' => 'Mohon masukkan password Anda.',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/'); // Balik ke halaman utama jika sukses
        }

        return back()->with('loginError', 'Username atau Password salah.')->withInput();
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function showRegister() {
        return view('register');
    }

    // --- REVISI: Fungsi register sekarang menyimpan Username (Tanpa Input Email) ---
    public function register(Request $request) {
        // 1. Validasi Input (Email sudah dihapus total dari sini)
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users', // Username wajib unik
            'password' => 'required|string|min:6|confirmed',
            'no_hp' => 'required|numeric|digits_between:10,15',
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username ini sudah dipakai, silakan cari yang lain.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.numeric' => 'Nomor HP harus berupa angka.',
            'no_hp.digits_between' => 'Nomor HP harus antara 10 hingga 15 digit.',
        ]);

        // 2. Simpan ke Tabel Tamu
        User::create([
            'name' => $request->nama_lengkap,
            'username' => $request->username, 
            // Trik aman: Generate email otomatis di belakang layar agar Laravel tidak error
            'email' => $request->username . '@tamu.com', 
            'password' => Hash::make($request->password),
            'no_hp' => $request->no_hp,
            'role' => 'tamu',
        ]);

        // 3. Redirect ke Login dengan Pesan Sukses
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login menggunakan Username Anda.');
    }

    public function showAdminLogin()
    {
        return view('admin.login');
    }

    public function adminLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            if (Auth::user()->role == 'admin') {
                $request->session()->regenerate();
                return redirect()->intended('/admin/dashboard');
            }
            Auth::logout();
            return back()->with('error', 'Akses ditolak!');
        }
        return back()->with('error', 'Username atau Password salah!');
    }
}