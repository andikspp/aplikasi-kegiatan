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
        Schema::create('soal', function (Blueprint $table) {
            $table->id();
            $table->text('pertanyaan'); // The main question text
            $table->string('kategori_soal'); // e.g., essai, nomor, tanggal, etc.
            $table->boolean('wajib_diisi')->default(false); // Required field
            $table->text('deskripsi')->nullable(); // Description, if provided
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soal');
    }
};
