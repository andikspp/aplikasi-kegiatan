<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Autentikasi;

class Admin extends Autentikasi
{
    use HasFactory;

    protected $fillable = [
        'username',
        'password',
    ];
}
