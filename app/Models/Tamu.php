<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tamu extends Model
{
    use HasFactory;

    // Pastikan nama tabelnya sesuai dengan yang ada di phpMyAdmin kamu
    protected $table = 'tamu'; 
    protected $primaryKey = 'id_tamu';

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'nama_lengkap',
        'email',
        'no_hp'
    ];
}