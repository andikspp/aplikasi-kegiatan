<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
