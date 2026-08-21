<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('reservasi', function (Blueprint $table) {
            // Kolom untuk jumlah orang tambahan TANPA kasur
            $table->integer('ekstra_orang')->default(0)->after('jumlah_kamar'); 
            // Kolom untuk jumlah orang tambahan DENGAN kasur
            $table->integer('ekstra_kasur')->default(0)->after('ekstra_orang');
        });
    }

    public function down()
    {
        Schema::table('reservasi', function (Blueprint $table) {
            $table->dropColumn(['ekstra_orang', 'ekstra_kasur']);
        });
    }
};