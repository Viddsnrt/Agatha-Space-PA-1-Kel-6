<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'table_id',
        'nama_pemesan',
        'tanggal',
        'jam',
        'durasi',
        'catatan',
    ];

    public function table()
    {
        return $this->belongsTo(Table::class);
    }
}
