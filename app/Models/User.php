<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes; // Tambahan 1: Import SoftDeletes
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes; // Tambahan 2: Aktifkan SoftDeletes di sini

    protected $table = 'users'; // Mengarah ke tabel pusat
    protected $primaryKey = 'id'; // Sesuai kolom di phpMyAdmin
    public $timestamps = true; // Di tabel users kamu ada created_at/updated_at

    protected $fillable = [
        'name',      // Nama untuk Admin/Tamu
        'username',  // Username untuk login Admin
        'email',     // Email untuk login Tamu
        'password',  // Password akun
        'no_hp',     // Nomor HP tamu
        'role',      // Penentu Admin atau Tamu
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'id_tamu', 'id');
    }

    // Jika kolom password di DB kamu namanya sudah 'password' (huruf kecil), 
    // fungsi getAuthPassword() sebenarnya tidak wajib ada lagi. 
    // Tapi tidak apa-apa kalau mau tetap dipasang untuk jaga-jaga.
}