<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
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

    // --- Tambahan untuk mendukung AdminLTE ---

    /**
     * Gambar profil pengguna di AdminLTE.
     *
     * @return string
     */
    public function adminlte_image()
    {
        return asset('images/default-avatar.png'); // Ganti jika punya kolom avatar sendiri
    }

    /**
     * Deskripsi singkat pengguna di dropdown AdminLTE.
     *
     * @return string
     */
    public function adminlte_desc()
    {
        return 'Admin'; // Bisa juga dari kolom role jika ada
    }

    /**
     * URL ke profil pengguna (jika ada).
     *
     * @return string
     */
    public function adminlte_profile_url()
    {
        return '#'; // Atau route('profile.show') jika punya halaman profil
    }
}
