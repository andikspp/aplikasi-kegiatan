<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KunciJawaban extends Model
{
    use HasFactory;

    protected $table = 'kunci_jawaban';
    protected $guarded = [];

    public function soal() : BelongsTo {
        return $this->belongsTo(Soal::class, 'soal_id', 'id');
    }
}
