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
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->unsignedBigInteger('pokja_id')->nullable();
            $table->date('tanggal_pendaftaran');
            $table->date('selesai_pendaftaran');
            $table->date('tanggal_kegiatan');
            $table->string('tempat_kegiatan');
            $table->string('jenis_kegiatan');
            $table->string('link_meeting')->nullable();
            $table->integer('jumlah_jp');
            $table->enum('membutuhkan_mapel', ['ya', 'tidak']);
            $table->enum('membutuhkan_nomor_rekening', ['ya', 'tidak']);
            $table->enum('membutuhkan_lokasi', ['ya', 'tidak']);
            $table->enum('membutuhkan_foto_presensi', ['ya', 'tidak']);
            $table->enum('menggunakan_sertifikat', ['ya', 'tidak']);
            $table->string('nomor_sertifikat')->nullable();
            $table->string('nomor_seri_sertifikat')->nullable();
            $table->string('template_sertifikat')->nullable();
            $table->date('tanggal_ttd_sertifikat')->nullable();
            $table->timestamps();

            $table->foreign('pokja_id')->references('id')->on('pokjas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->dropForeign(['pokja_id']);
        });

        Schema::dropIfExists('kegiatans');
    }
};
