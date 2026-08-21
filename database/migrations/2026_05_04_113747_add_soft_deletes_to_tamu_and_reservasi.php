<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Menambah kolom deleted_at di tabel users (untuk data Tamu)
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes(); 
        });

        // Menambah kolom deleted_at di tabel reservasi
        Schema::table('reservasi', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('reservasi', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};