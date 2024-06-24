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
        Schema::create('pengajuan_doc', function (Blueprint $table) {
            $table->id('pengajuan_doc_id');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_periode');
            $table->unsignedBigInteger('id_beasiswa');
            $table->string('dkbs');
            $table->string('surat_rekom');
            $table->string('surat_pernyataan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jns_doc');
    }
};
