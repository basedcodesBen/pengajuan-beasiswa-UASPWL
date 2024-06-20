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
        Schema::create('periode_beasiswa', function (Blueprint $table) {
            $table->id('id_periode');
            $table->unsignedBigInteger('id_beasiswa');
            $table->foreign('id_beasiswa')->references('id_beasiswa')->on('beasiswa');
            $table->year('tahun_ajaran');
            $table->string('triwulan');
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periode_beasiswa');
    }
};
