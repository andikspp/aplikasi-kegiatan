<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaKegiatan extends Model
{
    use HasFactory;

    protected $table = 'peserta_kegiatan';

    protected $fillable = [
        'kegiatan_id',
        'nama_lengkap',
        'nip',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'pendidikan_terakhir',
        'jabatan',
        'pangkat_golongan',
        'unit_kerja',
        'alamat_kantor',
        'telp_kantor',
        'alamat_rumah',
        'telp_rumah',
        'alamat_email',
        'npwp',
        'nomor_rekening',
        'peran',
        'surat_tugas',
        'tiket',
        'boarding_pass',
        'bukti_perjalanan',
        'sppd',
        'signature',
    ];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'kegiatan_id');
    }
}
