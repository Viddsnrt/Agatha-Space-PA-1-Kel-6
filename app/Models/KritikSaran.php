<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KritikSaran extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'email',
        'no_hp',
        'jenis', // 'kritik' atau 'saran'
        'pesan',
        'gambar',
        'tampilkan',
        'user_id', // Tambahkan ini jika kritik saran terkait dengan user dan Anda menyimpannya.
                   // Jika tidak, atau user_id bisa null, ini opsional di fillable
                   // tapi pastikan kolomnya ada di migrasi jika Anda menggunakan relasi user().
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tampilkan' => 'boolean', // Ini akan memastikan $kritiksaran->tampilkan selalu true/false
    ];

    /**
     * Get the user that owns the KritikSaran.
     * Pastikan tabel 'kritik_sarans' memiliki kolom 'user_id'.
     */
    public function user()
    {
        // Jika user_id bisa NULL di database, Anda mungkin ingin menggunakan withDefault()
        // untuk menghindari error jika mencoba mengakses properti user yang tidak ada.
        // return $this->belongsTo(User::class)->withDefault([
        //     'name' => 'Pengguna Tamu', // Atau nilai default yang sesuai
        // ]);
        return $this->belongsTo(User::class);
    }
}