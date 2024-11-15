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
        Schema::create('peran_kegiatan', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('id_kegiatan')->constrained('kegiatans')->onDelete('cascade');
            $table->bigInteger('id_kegiatan')->unsigned();
            $table->string('peran', 255);
            $table->enum('nomor_rekening', ['Ya', 'Tidak'])->nullable();

            $table->foreign('id_kegiatan')->references('id')->on('kegiatans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peran_kegiatan');
    }
};
