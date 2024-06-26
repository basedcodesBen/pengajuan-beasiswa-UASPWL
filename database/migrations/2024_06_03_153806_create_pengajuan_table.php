<?php

// database/migrations/create_pengajuan_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_beasiswa');
            $table->unsignedBigInteger('id_periode');
            $table->string('ipk');
            $table->integer('poin_portofolio');
            $table->boolean('status_1')->nullable();
            $table->boolean('status_2')->nullable();
            $table->timestamps();

            // Define composite primary key
            $table->primary(['id_user', 'id_beasiswa', 'id_periode']);

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_beasiswa')->references('id_beasiswa')->on('beasiswa')->onDelete('cascade');
            $table->foreign('id_periode')->references('id_periode')->on('periode_beasiswa')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuan');
    }
};

