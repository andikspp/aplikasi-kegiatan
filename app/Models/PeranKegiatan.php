<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeranKegiatan extends Model
{
    use HasFactory;

    protected $fillable = ['id_kegiatan', 'peran', 'nomor_rekening'];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'id_kegiatan');
    }
}
