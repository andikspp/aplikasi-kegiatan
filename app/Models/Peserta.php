<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    use HasFactory;

    protected $table = 'peserta';

    protected $fillable = [
        'user_id',
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
        'masa_kerja',
        'alamat_kantor',
        'telp_kantor',
        'alamat_rumah',
        'telp_rumah',
        'alamat_email',
        'npwp',
        'peran',
        'file_upload',
    ];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'kegiatan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
