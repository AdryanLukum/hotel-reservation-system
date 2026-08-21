<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kamar;
use App\Models\KamarNomor; // WAJIB DITAMBAHKAN: Untuk memanggil tabel data fisik kamar
use App\Models\Reservasi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 

class HomeController extends Controller
{
    // REVISI: Halaman Home sekarang hanya menampilkan profil & kebijakan
    public function index()
    {
        return view('home');
    }

    // Fungsi khusus untuk menampilkan halaman daftar kamar
    public function kamar()
    {
        // Mengambil semua data tipe kamar beserta daftar nomor kamarnya
        $data_kamar = Kamar::with('daftarNomor')->get();
        return view('kamar', compact('data_kamar'));
    }

    public function detail($id)
    {
        $kamar = Kamar::findOrFail($id);

        if (!Auth::check()) {
            session(['url.intended' => url()->current()]);
        }

        return view('detail', compact('kamar'));
    }

    // =========================================================
    // FUNGSI PESAN (UPDATE: ALGORITMA KUNCI KAMAR BERDASARKAN TANGGAL)
    // =========================================================
    public function pesan(Request $request, $id)
    {
        $request->validate([
            'tgl_checkin' => 'required|date',
            'tgl_checkout' => 'required|date|after:tgl_checkin',
            'jumlah' => 'required|integer|min:1',
            'ekstra_orang' => 'nullable|integer|min:0',
            'ekstra_kasur' => 'nullable|integer|min:0'
        ], [
            'tgl_checkin.required' => 'Mohon pilih tanggal Check-in terlebih dahulu.',
            'tgl_checkout.required' => 'Mohon pilih tanggal Check-out terlebih dahulu.',
            'tgl_checkout.after' => 'Tanggal Check-out harus lebih dari tanggal Check-in ya.',
            'jumlah.required' => 'Jumlah kamar tidak boleh kosong.',
            'jumlah.min' => 'Minimal pemesanan adalah 1 kamar.'
        ]);

        $kamar = Kamar::findOrFail($id);
        
        // --- LOGIKA HOTEL ASLI: CEK KETERSEDIAAN KAMAR BERDASARKAN TANGGAL ---
        
        // 1. Cari reservasi yang tanggalnya BENTROK dengan permintaan tamu
        $reservasiBentrok = Reservasi::where('id_kamar', $id)
            ->whereIn('status', ['Pending', 'Menunggu Konfirmasi', 'Lunas', 'Selesai']) // Yang batal tidak dihitung
            ->where(function ($query) use ($request) {
                // Rumus Overlap: Check-in Lama < Check-out Baru AND Check-out Lama > Check-in Baru
                $query->where('tgl_check_in', '<', $request->tgl_checkout)
                      ->where('tgl_check_out', '>', $request->tgl_checkin);
            })
            ->pluck('nomor_kamar_assigned')
            ->toArray();

        // 2. Pecah string nomor kamar (karena 1 reservasi bisa pesan >1 kamar, misal "101, 102")
        $nomorTerpakai = [];
        foreach($reservasiBentrok as $str) {
            if ($str) {
                $pecah = array_map('trim', explode(',', $str));
                $nomorTerpakai = array_merge($nomorTerpakai, $pecah);
            }
        }

        // 3. Cari nomor kamar yang BENAR-BENAR KOSONG di tanggal tersebut
        $kamarTersedia = KamarNomor::where('id_kamar', $id)
            ->where('status', 'Tersedia') // Abaikan yang sedang Maintenance
            ->whereNotIn('nomor_kamar', $nomorTerpakai)
            ->get();

        // 4. Validasi apakah jumlah kamar kosong mencukupi permintaan tamu
        if($kamarTersedia->count() < $request->jumlah) {
            return redirect()->back()->with('error', 'Maaf, hanya tersisa ' . $kamarTersedia->count() . ' kamar untuk tanggal tersebut. Silakan ubah jumlah pesanan atau pilih tanggal lain.');
        }

        // 5. Ambil/Kunci nomor kamar sesuai jumlah yang dipesan
        $kamarDipilih = $kamarTersedia->take($request->jumlah)->pluck('nomor_kamar')->implode(', ');
        
        // --- PERHITUNGAN BIAYA ---
        $checkin = Carbon::parse($request->tgl_checkin);
        $checkout = Carbon::parse($request->tgl_checkout);
        $durasi = $checkin->diffInDays($checkout);
        if($durasi <= 0) $durasi = 1;

        $ekstra_orang = $request->ekstra_orang ?? 0;
        $ekstra_kasur = $request->ekstra_kasur ?? 0;

        $harga_kamar_total = $kamar->harga * $request->jumlah * $durasi;
        $biaya_ekstra_orang = $ekstra_orang * 50000 * $durasi; 
        $biaya_ekstra_kasur = $ekstra_kasur * 75000 * $durasi; 

        $total = $harga_kamar_total + $biaya_ekstra_orang + $biaya_ekstra_kasur;

        $id_booking = 'INV-' . mt_rand(100000, 999999);
        $expired_at = Carbon::now()->addMinutes(40);

        // --- SIMPAN RESERVASI ---
        Reservasi::create([
            'id_reservasi' => $id_booking,
            'id_tamu' => Auth::user()->id,
            'id_kamar' => $id,
            'nomor_kamar_assigned' => $kamarDipilih, // Menyimpan kunci kamar fisik di sini
            'tgl_check_in' => $request->tgl_checkin,
            'tgl_check_out' => $request->tgl_checkout,
            'jumlah_kamar' => $request->jumlah,
            'ekstra_orang' => $ekstra_orang, 
            'ekstra_kasur' => $ekstra_kasur, 
            'total_bayar' => $total,
            'status' => 'Pending',
            'expired_at' => $expired_at 
        ]);

        return redirect()->route('tamu.riwayat')->with('success', 'Berhasil! Anda mendapat Kamar: ' . $kamarDipilih . '. Segera bayar sebelum jam ' . $expired_at->format('H:i') . ' WIB');
    }

    private function bersihkanPesananKadaluarsa()
    {
        $pesananExpired = Reservasi::where('status', 'Pending')
                                ->where('expired_at', '<', Carbon::now())
                                ->get();

        foreach ($pesananExpired as $pesanan) {
            // REVISI: Logika stok manual dihapus. Sistem cukup mengubah status jadi 'Batal', 
            // maka kamar otomatis akan terbaca kosong lagi oleh query pencarian di atas.
            $pesanan->update(['status' => 'Batal']);
        }
    }

    // =========================================================
    // FUNGSI RIWAYAT (URUTAN BERDASARKAN TANGGAL TERBARU)
    // =========================================================
    public function riwayat()
    {
        $this->bersihkanPesananKadaluarsa();

        $data_pesanan = Reservasi::where('id_tamu', Auth::user()->id)
                        ->with('kamar')
                        ->orderBy('tgl_pesan', 'DESC') 
                        ->get();
                        
        return view('riwayat', compact('data_pesanan'));
    }

    public function pembayaran($id)
    {
        $reservasi = Reservasi::with('kamar')->findOrFail($id);
        return view('pembayaran', compact('reservasi'));
    }

    public function uploadPembayaran(Request $request, $id)
    {
        $request->validate([
            'bukti_bayar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'bukti_bayar.required' => 'Maaf, Anda belum memilih file bukti pembayaran.',
            'bukti_bayar.image'    => 'Mohon pastikan file yang Anda unggah adalah sebuah gambar.',
            'bukti_bayar.mimes'    => 'Format gambar tidak didukung. Tolong gunakan format JPG, JPEG, atau PNG.',
            'bukti_bayar.max'      => 'Ukuran gambar terlalu besar. Maksimal ukuran file adalah 2 MB.'
        ]);

        if ($request->hasFile('bukti_bayar')) {
            $file = $request->file('bukti_bayar');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('gambar_bukti'), $nama_file);

            Reservasi::where('id_reservasi', $id)->update([
                'status' => 'Menunggu Konfirmasi',
                'bukti_bayar' => $nama_file
            ]);
        }

        return redirect()->route('tamu.riwayat')->with('success', 'Bukti pembayaran berhasil diunggah! Mohon tunggu verifikasi admin.');
    }

    public function batal($id)
    {
        $reservasi = Reservasi::where('id_reservasi', $id)
                            ->where('id_tamu', Auth::user()->id)
                            ->firstOrFail();

        if ($reservasi->status == 'Pending') {
            // REVISI: Logika stok manual dihapus. 
            // Mengubah status menjadi Batal otomatis melepaskan kuncian nomor kamar.
            $reservasi->update(['status' => 'Batal']);
            return redirect()->back()->with('success', 'Pesanan berhasil dibatalkan.');
        }

        return redirect()->back()->with('error', 'Pesanan ini tidak dapat dibatalkan.');
    }

    public function cetak($id)
    {
        $reservasi = Reservasi::with(['kamar', 'tamu'])
                    ->where('id_reservasi', $id)
                    ->where('id_tamu', Auth::user()->id)
                    ->firstOrFail();

        return view('cetak', compact('reservasi'));
    }

    // =========================================================================
    //  HALAMAN PROFIL TAMU
    // =========================================================================
    public function profil()
    {
        return view('profil');
    }

    public function updateProfil(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);

        $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username,' . $user->id, 
            'no_hp'    => 'required|numeric',
        ], [
            'username.required' => 'Username tidak boleh kosong.',
            'username.unique'   => 'Username ini sudah dipakai oleh tamu lain. Silakan pilih yang berbeda.',
        ]);

        $user->update([
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->username . '@tamu.com', 
            'no_hp'    => $request->no_hp,
        ]);

        return redirect()->back()->with('success', 'Data profil berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password'     => 'required|min:6|confirmed',
        ], [
            'new_password.confirmed' => 'Konfirmasi password baru tidak cocok.',
            'new_password.min'       => 'Password baru minimal 6 karakter.'
        ]);

        $user = User::findOrFail(Auth::user()->id);

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Password saat ini salah.');
        }

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->back()->with('success', 'Password berhasil diubah!');
    }
}