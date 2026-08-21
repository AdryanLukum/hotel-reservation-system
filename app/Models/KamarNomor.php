<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KamarNomor extends Model
{
    protected $table = 'kamar_nomor';
    protected $primaryKey = 'id_kamar_nomor';
    public $timestamps = false;

    protected $fillable = [
        'id_kamar', 
        'nomor_kamar', 
        'status'
    ];

    // Relasi balik ke tipe kamar induknya
    public function kamar() {
        return $this->belongsTo(Kamar::class, 'id_kamar', 'id_kamar');
    }
}