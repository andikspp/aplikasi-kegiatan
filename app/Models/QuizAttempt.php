<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuizAttempt extends Model
{
    use HasFactory;
    protected $table = 'quiz_attempt';
    protected $guarded = [];

    public function user() : BelongsTo {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function quiz() : BelongsTo {
        return $this->belongsTo(Quizz::class, 'quiz_id', 'id');
    }

    public function jawaban() : HasMany {
        return $this->hasMany(QuizJawaban::class, 'attempt_id', 'id');
    }
}
