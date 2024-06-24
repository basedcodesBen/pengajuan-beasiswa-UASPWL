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
        Schema::create('pengajuan_pengajuan_doc', function (Blueprint $table) {
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_periode');
            $table->unsignedBigInteger('id_beasiswa');
            $table->unsignedBigInteger('pengajuan_doc_id');
            $table->string('file_path');
            $table->timestamps();

            // Define foreign keys
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_periode')->references('id_periode')->on('periode_beasiswa')->onDelete('cascade');
            $table->foreign('id_beasiswa')->references('id_beasiswa')->on('beasiswa')->onDelete('cascade');
            $table->foreign('pengajuan_doc_id')->references('pengajuan_doc_id')->on('pengajuan_doc')->onDelete('cascade');

            // Define composite primary key
            $table->primary(['id_user', 'id_periode', 'id_beasiswa', 'pengajuan_doc_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_pengajuan_doc');
    }
};

