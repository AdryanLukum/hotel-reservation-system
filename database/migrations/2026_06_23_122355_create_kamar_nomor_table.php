<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kamar_nomor', function (Blueprint $table) {
            $table->id('id_kamar_nomor');
            $table->integer('id_kamar'); // Relasi ke tabel kamar (tipe induk)
            $table->string('nomor_kamar', 50); // Contoh: "101", "102", "Mawar"
            $table->enum('status', ['Tersedia', 'Maintenance'])->default('Tersedia');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kamar_nomor');
    }
};