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
        Schema::create('prodi', function (Blueprint $table) {
            $table->string('id_prodi')->primary();
            $table->string('nama_prodi');
            $table->string('id_fakultas'); // Foreign key column
            $table->timestamps();

            // Define the foreign key constraint
            $table->foreign('id_fakultas')
                  ->references('id_fakultas')
                  ->on('fakultas')
                  ->onDelete('cascade'); // Optional: specify action on delete
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prodi');
    }
};

