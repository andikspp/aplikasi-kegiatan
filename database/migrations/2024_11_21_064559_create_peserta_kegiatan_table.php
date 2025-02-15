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
        Schema::create('peserta_kegiatan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kegiatan_id');
            $table->string('nama_lengkap');
            $table->string('nip')->nullable();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('agama');
            $table->string('pendidikan_terakhir');
            $table->string('jabatan');
            $table->string('pangkat_golongan')->nullable(); // Pangkat Golongan, nullable for non-PNS
            $table->string('unit_kerja');
            $table->string('alamat_kantor');
            $table->string('telp_kantor');
            $table->string('alamat_rumah');
            $table->string('telp_rumah');
            $table->string('alamat_email');
            $table->string('npwp');
            $table->string('nomor_rekening')->nullable();
            $table->string('peran', 255);
            $table->string('surat_tugas')->nullable();
            $table->string('tiket')->nullable();
            $table->string('boarding_pass')->nullable();
            $table->string('bukti_perjalanan')->nullable();
            $table->string('sppd')->nullable();
            $table->string('signature');
            $table->timestamps();

            $table->foreign('kegiatan_id')->references('id')->on('kegiatans')->onDelete('cascade');
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
