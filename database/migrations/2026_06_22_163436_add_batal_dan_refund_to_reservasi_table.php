<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('reservasi', function (Blueprint $table) {
            $table->text('alasan_batal')->nullable()->after('status');
            $table->string('status_refund')->default('Tidak Ada')->after('alasan_batal');
            $table->string('bukti_refund')->nullable()->after('status_refund');
        });
    }

    public function down()
    {
        Schema::table('reservasi', function (Blueprint $table) {
            $table->dropColumn(['alasan_batal', 'status_refund', 'bukti_refund']);
        });
    }
};