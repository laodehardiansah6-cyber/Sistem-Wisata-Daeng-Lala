<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pesanan',
        'user_id',
        'jenis',
        'item_nama',
        'jumlah',
        'total_harga',
        'status_pesanan',
        'status_pembayaran',
        'metode_pembayaran',
        'bukti_transfer',
        'catatan',
        'nomor_wa', 
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
