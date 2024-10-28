<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('kegiatan', function (Blueprint $table) {
            // Tambahkan kolom baru yang diperlukan
            $table->boolean('butuh_mapel')->default(false);
            $table->boolean('butuh_rekening')->default(false);
            $table->boolean('butuh_lokasi')->default(false);
            $table->boolean('butuh_foto_presensi')->default(false);
            $table->boolean('gunakan_sertifikat')->default(false);
            // ... kolom lainnya
        });
    }

    public function down()
    {
        Schema::table('kegiatan', function (Blueprint $table) {
            // Hapus kolom yang ditambahkan
            $table->dropColumn([
                'butuh_mapel',
                'butuh_rekening',
                'butuh_lokasi',
                'butuh_foto_presensi',
                'gunakan_sertifikat'
            ]);
        });
    }
};