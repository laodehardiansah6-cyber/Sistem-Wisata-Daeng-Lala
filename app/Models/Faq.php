<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    // Mengizinkan semua kolom untuk diisi secara otomatis (Solusi dari error sebelumnya)
    protected $guarded = [];
}
