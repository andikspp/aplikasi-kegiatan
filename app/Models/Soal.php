<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Soal extends Model
{
    use HasFactory;

    protected $table = 'soal';

    protected $fillable = [
        'quiz_id',
        'pertanyaan',
        'kategori_soal',
    ];

    public function quiz()
    {
        return $this->belongsTo(Quizz::class, 'quiz_id');
    }

    public function kunci_jawaban() : HasMany {
        return $this->hasMany(KunciJawaban::class, 'soal_id', 'id');
    }

    public function jawaban() : HasMany {
        return $this->hasMany(Jawaban::class, 'soal_id', 'id');
    }
}
