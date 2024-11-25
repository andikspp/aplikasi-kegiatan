<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'pertanyaan',
        'kategori_soal',
        'deskripsi',
    ];
}
