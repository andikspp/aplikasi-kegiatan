<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Soal extends Model
{
    use HasFactory;

    protected $table = 'soal';

    protected $guarded = [];

    public function quiz()
    {
        return $this->belongsTo(Quizz::class, 'quiz_id');
    }

    public function jawaban(): HasMany
    {
        return $this->hasMany(OpsiJawaban::class, 'soal_id', 'id');
    }
}
