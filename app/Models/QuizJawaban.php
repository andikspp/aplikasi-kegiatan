<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuizJawaban extends Model
{
    use HasFactory;
    protected $table = 'quiz_jawaban';
    protected $guarded = [];

    public function attempt() : BelongsTo {
        return $this->belongsTo(QuizAttempt::class, 'attempt_id', 'id');
    }
    
    public function soal() : BelongsTo {
        return $this->belongsTo(Soal::class, 'soal_id', 'id');
    }
}
