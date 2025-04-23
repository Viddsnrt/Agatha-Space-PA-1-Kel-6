<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KritikSaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'email',
        'no_hp',
        'jenis',
        'pesan', // tambahkan ini
        'gambar',
        'tampilkan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
