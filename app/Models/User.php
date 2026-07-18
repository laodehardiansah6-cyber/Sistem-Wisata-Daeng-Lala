<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     * Kolom apa saja yang boleh diisi (termasuk 'role' dan 'google_id')
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', 
        'google_id', 
        'profile_photo', // <-- Tambahan agar kolom foto profil bisa diisi
    ];

    /**
     * The attributes that should be hidden for serialization.
     * Data yang disembunyikan agar aman (password tidak bocor)
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     * Mengubah format data, misalnya password langsung dienkripsi (hashed)
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi Database: Satu User bisa melakukan banyak Pemesanan
     */
    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class);
    }
}
