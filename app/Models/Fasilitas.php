<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    use HasFactory;
    
    protected $table = 'fasilitas';
    
    // Pastikan semua kolom yang ada di database dimasukkan ke sini
    protected $fillable = [
        'nama_fasilitas', 
        'kategori', 
        'deskripsi', 
        'harga', 
        'satuan', 
        'gambar'
    ];
}
