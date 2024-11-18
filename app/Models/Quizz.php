<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Quizz extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai dengan konvensi Laravel
    protected $table = 'quizz';

    // Tentukan kolom yang dapat diisi massal
    protected $fillable = [
        'kegiatan_id',
        'judul',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
    ];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'kegiatan_id');
    }

    public function soal()
    {
        return $this->hasMany(Soal::class, 'quizz_id');
    }

    // Jika Anda ingin menambahkan relasi, Anda bisa menambahkannya di sini
    // Contoh: public function jawaban() { return $this->hasMany(OpsiJawaban::class); }
}
