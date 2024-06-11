<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id('id_pengajuan');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
            $table->unsignedBigInteger('id_beasiswa');
            $table->foreign('id_beasiswa')->references('id_beasiswa')->on('beasiswa');
            $table->unsignedBigInteger('id_periode');
            $table->foreign('id_periode')->references('id_periode')->on('periode_beasiswa');
            $table->string('nrp');
            $table->string('nama');
            $table->string('ipk');
            $table->string('transkrip');
            $table->string('surat_rekom');
            $table->string('surat_pernyataan');
            $table->string('bukti_keaktifan');
            $table->string('dokum_pendukung');
            $table->string('status_approve');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan');
    }
};
