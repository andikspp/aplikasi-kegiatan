<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokja extends Model
{
    use HasFactory;

    public function kegiatans()
    {
        return $this->hasMany(Kegiatan::class);
    }
}
