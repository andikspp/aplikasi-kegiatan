<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatans';

    protected $fillable = [
        'nama',
        'pokja_id',
        'tanggal_pendaftaran',
        'selesai_pendaftaran',
        'tanggal_kegiatan',
        'tempat_kegiatan',
        'jenis_kegiatan',
        'link_meeting',
        'jumlah_jp',
        'membutuhkan_mapel',
        'membutuhkan_nomor_rekening',
        'membutuhkan_lokasi',
        'membutuhkan_foto_presensi',
        'menggunakan_sertifikat',
        'nomor_sertifikat',
        'nomor_seri_sertifikat',
        'template_sertifikat',
        'tanggal_ttd_sertifikat',
    ];

    public function peranKegiatan()
    {
        return $this->hasMany(PeranKegiatan::class, 'id_kegiatan');
    }

    public function quiz()
    {
        return $this->hasMany(Quizz::class, 'kegiatan_id');
    }

    public function peserta()
    {
        return $this->hasMany(Peserta::class, 'kegiatan_id');
    }

    public function pokja()
    {
        return $this->belongsTo(Pokja::class);
    }
}
