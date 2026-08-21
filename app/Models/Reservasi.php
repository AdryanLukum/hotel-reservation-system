<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Tambahan 1: Import SoftDeletes

class Reservasi extends Model
{
    use SoftDeletes; // Tambahan 2: Aktifkan SoftDeletes di sini

    protected $table = 'reservasi';
    protected $primaryKey = 'id_reservasi';
    // Beri tahu Laravel kalau Primary Key-nya bukan angka otomatis (Auto Increment)
    public $incrementing = false;
    protected $keyType = 'string';
   
    public $timestamps = false;
    protected $casts = [
        'tgl_pesan' => 'datetime',
    ];

    protected $fillable = [
        'id_reservasi',
        'id_tamu', 
        'id_kamar', 
        'tgl_check_in',  
        'tgl_check_out', 
        'jumlah_kamar', 
        'ekstra_orang',  
        'ekstra_kasur',  
        'total_bayar',   
        'status',
        'expired_at',
        'alasan_batal',   // REVISI: Mengizinkan pengisian alasan pembatalan
        'status_refund',  // REVISI: Mengizinkan pengisian status refund dana
        'bukti_refund',    // REVISI: Mengizinkan pengisian nama file bukti refund
        'nomor_kamar_assigned'
    ];
    
    // Relasi ke model Kamar
    public function kamar() {
        return $this->belongsTo(Kamar::class, 'id_kamar');
    }

    public function tamu()
    {
        // Hubungkan ke model User, bukan model Tamu lagi
        return $this->belongsTo(User::class, 'id_tamu', 'id');
    }
}