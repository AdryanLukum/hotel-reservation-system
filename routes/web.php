<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

// =========================================================
// 1. RUTE PUBLIK (Bisa dibuka siapa saja tanpa login)
// =========================================================
Route::get('/', [HomeController::class, 'index'])->name('home');

// TAMBAHAN BARU: Rute khusus untuk Halaman Daftar Kamar
Route::get('/kamar', [HomeController::class, 'kamar'])->name('kamar');

Route::get('/kamar/{id}', [HomeController::class, 'detail'])->name('kamar.detail');

// (Rute /about sudah dihapus sesuai revisi)

// =========================================================
// 2. RUTE GUEST (Hanya untuk orang yang BELUM login)
// =========================================================
Route::middleware(['guest'])->group(function () {
    // Rute Login & Register Tamu
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Rute khusus Login Admin
    Route::get('/admin/login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
    Route::post('/admin/login', [AuthController::class, 'adminLogin']);
});

// =========================================================
// 3. RUTE AUTH (Wajib Login)
// =========================================================
Route::middleware(['auth'])->group(function () {
    
    // Tombol Logout (Bebas diakses Admin maupun Tamu)
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // ---------------------------------------------------------
    // A. KAMAR KHUSUS TAMU (Hanya boleh diakses user dengan role 'tamu')
    // ---------------------------------------------------------
    Route::middleware(['role:tamu'])->group(function () {
        // Reservasi & Pembayaran
        Route::post('/kamar/pesan/{id}', [HomeController::class, 'pesan'])->name('kamar.pesan');
        Route::get('/riwayat', [HomeController::class, 'riwayat'])->name('tamu.riwayat');
        Route::get('/pembayaran/{id}', [HomeController::class, 'pembayaran'])->name('pembayaran');
        Route::post('/pembayaran/upload/{id}', [HomeController::class, 'uploadPembayaran'])->name('pembayaran.upload');
        Route::post('/reservasi/batal/{id}', [HomeController::class, 'batal'])->name('tamu.reservasi.batal');
        
        // Profil
        Route::get('/profil', [HomeController::class, 'profil'])->name('tamu.profil');
        Route::post('/profil/update', [HomeController::class, 'updateProfil'])->name('tamu.profil.update');
        Route::post('/profil/password', [HomeController::class, 'updatePassword'])->name('tamu.profil.password');

        // Cetak Struk
        Route::get('/tamu/cetak/{id}', [HomeController::class, 'cetak'])->name('tamu.cetak');
    });

    // ---------------------------------------------------------
    // B. KAMAR KHUSUS ADMIN (Hanya boleh diakses user dengan role 'admin')
    // ---------------------------------------------------------
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        
        // Manajemen Reservasi
        Route::post('/admin/reservasi/konfirmasi/{id}', [AdminController::class, 'konfirmasi'])->name('admin.reservasi.konfirmasi');
        
        // TAMBAHAN BARU: Route untuk tombol Tolak
        Route::post('/admin/reservasi/tolak/{id}', [AdminController::class, 'tolak'])->name('admin.reservasi.tolak');
        // Rute untuk proses unggah bukti Refund
        Route::post('/admin/reservasi/refund/{id}', [AdminController::class, 'prosesRefund'])->name('admin.reservasi.refund');
        
        Route::delete('/admin/reservasi/{id}', [AdminController::class, 'destroy'])->name('admin.reservasi.destroy');
        Route::post('/admin/reservasi/batal/{id}', [AdminController::class, 'cancel'])->name('admin.reservasi.cancel');
        Route::post('/admin/reservasi/checkout/{id}', [AdminController::class, 'checkout'])->name('admin.reservasi.checkout');

        // Manajemen Kamar (CRUD)
        Route::get('/admin/kamar', [AdminController::class, 'kamar'])->name('admin.kamar');
        Route::get('/admin/kamar/tambah', [AdminController::class, 'createKamar'])->name('admin.kamar.create');
        Route::post('/admin/kamar/simpan', [AdminController::class, 'storeKamar'])->name('admin.kamar.store');
        Route::get('/admin/kamar/edit/{id}', [AdminController::class, 'editKamar'])->name('admin.kamar.edit');
        Route::post('/admin/kamar/update/{id}', [AdminController::class, 'updateKamar'])->name('admin.kamar.update');
        Route::delete('/admin/kamar/hapus/{id}', [AdminController::class, 'destroyKamar'])->name('admin.kamar.destroy');

        // Manajemen Tamu & Laporan
        Route::get('/admin/tamu', [AdminController::class, 'tamu'])->name('admin.tamu');
        Route::delete('/admin/tamu/hapus/{id}', [AdminController::class, 'destroyTamu'])->name('admin.tamu.destroy');
        Route::post('/admin/tamu/{id}/reset-password', [AdminController::class, 'resetPasswordTamu'])->name('admin.tamu.reset_password');
        Route::get('/admin/laporan', [AdminController::class, 'laporan'])->name('admin.laporan');

        // Arsip Data (SOFT DELETES)
        Route::get('/admin/arsip', [AdminController::class, 'arsip'])->name('admin.arsip');
        
        // Arsip Tamu
        Route::post('/admin/arsip/tamu/{id}/restore', [AdminController::class, 'restoreTamu'])->name('admin.tamu.restore');
        Route::delete('/admin/arsip/tamu/{id}/force', [AdminController::class, 'forceDeleteTamu'])->name('admin.tamu.force_delete');
        
        // Arsip Reservasi
        Route::post('/admin/arsip/reservasi/{id}/restore', [AdminController::class, 'restoreReservasi'])->name('admin.reservasi.restore');
        Route::delete('/admin/arsip/reservasi/{id}/force', [AdminController::class, 'forceDeleteReservasi'])->name('admin.reservasi.force_delete');
    });
});