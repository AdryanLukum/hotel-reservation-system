<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\Kamar;
use App\Models\KamarNomor;
use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Str; 

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $sort = $request->get('sort', 'terbaru');
        $urutan = ($sort == 'terlama') ? 'ASC' : 'DESC';

        $reservasi = Reservasi::with(['tamu' => function($query) {
                        $query->withTrashed();
                    }, 'kamar'])
                    ->orderBy('tgl_pesan', $urutan)
                    ->get();

        return view('admin.dashboard', compact('reservasi', 'sort'));
    }

    public function destroy($id)
    {
        $reservasi = Reservasi::where('id_reservasi', $id)->firstOrFail();
        $reservasi->delete(); 
        return redirect()->back()->with('success', 'Data reservasi berhasil dipindah ke Arsip.');
    }

    // --- FITUR MANAJEMEN KAMAR ---
    public function kamar()
    {
        $data_kamar = Kamar::with('daftarNomor')->get();
        return view('admin.kamar', compact('data_kamar'));
    }

    public function createKamar() {
        return view('admin.tambah_kamar');
    }

    public function storeKamar(Request $request) {
        $request->validate([
            'tipe_kamar' => 'required',
            'harga'      => 'required|numeric',
            'kapasitas'  => 'required|numeric',
            'nomor_kamar_list' => 'nullable|string', // Diubah menjadi nullable
            'fasilitas'  => 'required', 
            'foto'       => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $file = $request->file('foto');
        $nama_file = time() . "_" . $file->getClientOriginalName();
        $file->move(public_path('gambar'), $nama_file);

        // Cek jika kosong, jika ada isi maka dipecah dan dibersihkan dari array kosong
        $inputNomorKamar = $request->nomor_kamar_list;
        $daftar_nomor = empty($inputNomorKamar) ? [] : array_filter(array_map('trim', explode(',', $inputNomorKamar)));

        $kamar = Kamar::create([
            'tipe_kamar' => $request->tipe_kamar,
            'harga'      => $request->harga,
            'kapasitas'  => $request->kapasitas,
            'stok'       => count($daftar_nomor),
            'fasilitas'  => $request->fasilitas,
            'foto'       => $nama_file,
        ]);

        if (!empty($daftar_nomor)) {
            foreach ($daftar_nomor as $nomor) {
                if(!empty($nomor)) {
                    KamarNomor::create([
                        'id_kamar'    => $kamar->id_kamar,
                        'nomor_kamar' => $nomor,
                        'status'      => 'Tersedia'
                    ]);
                }
            }
        }

        return redirect()->route('admin.kamar')->with('success', 'Kamar berhasil ditambahkan!');
    }

    public function editKamar($id)
    {
        $kamar = Kamar::with('daftarNomor')->findOrFail($id);
        return view('admin.edit_kamar', compact('kamar'));
    }

    public function updateKamar(Request $request, $id)
    {
        $kamar = Kamar::findOrFail($id);
        
        $request->validate([
            'tipe_kamar' => 'required',
            'harga'      => 'required|numeric',
            'kapasitas'  => 'required|numeric',
            'nomor_kamar_list' => 'nullable|string', // Diubah menjadi nullable
            'fasilitas'  => 'required',
            'foto'       => 'image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $inputNomorKamar = $request->nomor_kamar_list;
        $daftar_nomor = empty($inputNomorKamar) ? [] : array_filter(array_map('trim', explode(',', $inputNomorKamar)));
        
        $data = $request->only(['tipe_kamar', 'harga', 'kapasitas', 'fasilitas']);
        $data['stok'] = count($daftar_nomor); // Stok diset otomatis berdasarkan hitungan list

        if ($request->hasFile('foto')) {
            if ($kamar->foto && file_exists(public_path('gambar/' . $kamar->foto))) {
                unlink(public_path('gambar/' . $kamar->foto));
            }
            $file = $request->file('foto');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('gambar'), $nama_file);
            $data['foto'] = $nama_file;
        }

        $kamar->update($data);

        // Reset nomor kamar lama
        KamarNomor::where('id_kamar', $kamar->id_kamar)->delete();
        
        // Masukkan nomor kamar baru jika tidak kosong
        if (!empty($daftar_nomor)) {
            foreach ($daftar_nomor as $nomor) {
                if(!empty($nomor)) {
                    KamarNomor::create([
                        'id_kamar'    => $kamar->id_kamar,
                        'nomor_kamar' => $nomor,
                        'status'      => 'Tersedia'
                    ]);
                }
            }
        }

        return redirect()->route('admin.kamar')->with('success', 'Data kamar berhasil diperbarui!');
    }

    public function destroyKamar($id)
    {
        $kamar = Kamar::findOrFail($id);
        if ($kamar->foto && file_exists(public_path('gambar/' . $kamar->foto))) {
            unlink(public_path('gambar/' . $kamar->foto));
        }
        $kamar->delete();
        return redirect()->route('admin.kamar')->with('success', 'Data kamar berhasil dihapus!');
    }

    // --- FITUR TAMU & LAPORAN ---
    public function tamu()
    {
        $data_tamu = User::where('role', 'tamu')->get();
        return view('admin.tamu', compact('data_tamu'));
    }

    public function destroyTamu($id)
    {
        User::findOrFail($id)->delete(); 
        return redirect()->back()->with('success', 'Data tamu berhasil dipindah ke Arsip.');
    }

    public function resetPasswordTamu($id)
    {
        $tamu = User::findOrFail($id);
        $passwordBaru = Str::random(6);
        $tamu->update(['password' => Hash::make($passwordBaru)]);
        return redirect()->back()->with('success', 'Password berhasil direset: ' . $passwordBaru);
    }

    public function laporan(Request $request)
    {
        $bulan = $request->get('bulan', date('m'));
        $tahun = $request->get('tahun', date('Y'));
        $laporan = Reservasi::with(['kamar', 'tamu' => function($query) { $query->withTrashed(); }])
                    ->whereIn('status', ['Selesai', 'Lunas'])
                    ->whereMonth('tgl_pesan', $bulan)
                    ->whereYear('tgl_pesan', $tahun)
                    ->get();
        $total_pendapatan = $laporan->sum('total_bayar');
        return view('admin.laporan', compact('laporan', 'total_pendapatan', 'bulan', 'tahun'));
    }

    // --- MANAJEMEN RESERVASI & REFUND ---
    public function konfirmasi($id)
    {
        $reservasi = Reservasi::where('id_reservasi', $id)->firstOrFail();
        $reservasi->update(['status' => 'Lunas']);
        return redirect()->back()->with('success', 'Pembayaran Berhasil Dikonfirmasi!');
    }

    public function tolak(Request $request, $id)
    {
        $reservasi = Reservasi::where('id_reservasi', $id)->firstOrFail();
        $request->validate(['alasan_utama' => 'required|string', 'alasan_detail' => 'nullable|string|max:255']);

        $alasan_final = $request->alasan_utama . ($request->alasan_detail ? ' - Detail: ' . $request->alasan_detail : '');

        $status_baru = 'Batal';
        $status_refund = ($reservasi->status == 'Menunggu Konfirmasi') ? 'Menunggu Refund' : 'Tidak Ada';

        $reservasi->update([
            'status' => $status_baru,
            'alasan_batal' => $alasan_final,
            'status_refund' => $status_refund
        ]);

        return redirect()->back()->with('success', 'Pesanan dibatalkan.');
    }

    public function prosesRefund(Request $request, $id)
    {
        $reservasi = Reservasi::where('id_reservasi', $id)->firstOrFail();
        $request->validate(['bukti_refund' => 'required|image|mimes:jpeg,png,jpg|max:2048']);

        $file = $request->file('bukti_refund');
        $nama_file = time() . "_refund_" . $file->getClientOriginalName();
        $file->move(public_path('gambar_bukti'), $nama_file);

        $reservasi->update(['status_refund' => 'Refund Selesai', 'bukti_refund' => $nama_file]);
        return redirect()->back()->with('success', 'Bukti Refund berhasil diunggah.');
    }

    public function checkout($id)
    {
        $reservasi = Reservasi::where('id_reservasi', $id)->firstOrFail();
        if ($reservasi->status == 'Lunas') {
            $reservasi->update(['status' => 'Selesai']);
            return redirect()->back()->with('success', 'Check-out berhasil.');
        }
        return redirect()->back()->with('error', 'Hanya pesanan Lunas yang bisa di-checkout.');
    }

    // --- ARSIP DATA ---
    public function arsip()
    {
        $tamu_dihapus = User::onlyTrashed()->where('role', 'tamu')->get();
        $reservasi_dihapus = Reservasi::onlyTrashed()->with(['tamu' => function($query) { $query->withTrashed(); }, 'kamar'])->get();
        return view('admin.arsip', compact('tamu_dihapus', 'reservasi_dihapus'));
    }

    public function restoreTamu($id) { User::withTrashed()->findOrFail($id)->restore(); return redirect()->back()->with('success', 'Data dipulihkan.'); }
    public function forceDeleteTamu($id) { User::withTrashed()->findOrFail($id)->forceDelete(); return redirect()->back()->with('success', 'Data dihapus permanen.'); }
    public function restoreReservasi($id) { Reservasi::onlyTrashed()->where('id_reservasi', $id)->firstOrFail()->restore(); return redirect()->back()->with('success', 'Data dipulihkan.'); }
    public function forceDeleteReservasi($id) { Reservasi::onlyTrashed()->where('id_reservasi', $id)->firstOrFail()->forceDelete(); return redirect()->back()->with('success', 'Data dihapus permanen.'); }
}