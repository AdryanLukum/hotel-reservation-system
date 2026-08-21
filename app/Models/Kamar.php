<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    // 1. Kasih tahu nama tabelnya (Kalau gak diisi, Laravel nyarinya 'kamars')
    protected $table = 'kamar';

    // 2. Kasih tahu Primary Key-nya (Kalau gak diisi, Laravel nyarinya 'id')
    protected $primaryKey = 'id_kamar';

    // 3. Matikan timestamp (Karena tabel lama gak punya kolom created_at & updated_at)
    public $timestamps = false;

    // 4. Daftar kolom yang boleh diisi (Mass Assignment)
    protected $fillable = [
        'tipe_kamar', 
        'harga', 
        'kapasitas', 
        'stok', 
        'fasilitas', 
        'foto'
    ];

    // Relasi ke data fisik kamar (nomor-nomornya)
    public function daftarNomor() {
        return $this->hasMany(KamarNomor::class, 'id_kamar', 'id_kamar');
    }
}