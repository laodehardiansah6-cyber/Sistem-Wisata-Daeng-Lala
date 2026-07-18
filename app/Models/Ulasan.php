<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'jenis',
        'item_id',
        'rating',
        'komentar'
    ];

    // Relasi: 1 Ulasan dimiliki oleh 1 User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
