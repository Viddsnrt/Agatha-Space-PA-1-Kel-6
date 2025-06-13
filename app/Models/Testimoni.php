<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// UBAH NAMA CLASS
class Testimoni extends Model
{
    use HasFactory;

    // UBAH NAMA TABEL JIKA BERBEDA DENGAN PLURAL DARI NAMA MODEL
    protected $table = 'testimonis'; // Sesuaikan jika nama tabel Anda berbeda

    // Sesuaikan $fillable dengan kolom yang ada di migrasi baru
    protected $fillable = [
        'nama',
        'email',
        'no_hp',
        'jenis', // 'testimoni' atau 'saran'
        'pesan',
        'gambar',
        'tampilkan',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'tampilkan' => 'boolean', // Pastikan 'tampilkan' di-cast sebagai boolean
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}