<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('reservasi', function (Blueprint $table) {
            // Menambahkan kolom untuk menyimpan nomor kamar yang di-assign admin
            $table->string('nomor_kamar_assigned')->nullable()->after('status');
        });
    }

    public function down()
    {
        Schema::table('reservasi', function (Blueprint $table) {
            $table->dropColumn('nomor_kamar_assigned');
        });
    }
};