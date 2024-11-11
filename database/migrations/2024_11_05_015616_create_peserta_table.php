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
        Schema::create('peserta', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('nip')->nullable();
            $table->string('tempat_tanggal_lahir');
            $table->string('jenis_kelamin');
            $table->string('agama');
            $table->string('pendidikan_terakhir');
            $table->string('jabatan');
            $table->string('pangkat_golongan')->nullable();
            $table->string('unit_kerja');
            $table->string('masa_kerja')->nullable();
            $table->string('alamat_kantor');
            $table->string('telp_kantor')->nullable();
            $table->string('alamat_rumah');
            $table->string('telp_hp')->nullable();
            $table->string('alamat_email')->nullable();
            $table->string('npwp')->nullable();
            $table->string('file_upload')->nullable(); // Kolom untuk menyimpan hasil upload file
            $table->date('tanggal_daftar')->nullable(); // Menambahkan kolom tanggal_daftar
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta');
    }
};
