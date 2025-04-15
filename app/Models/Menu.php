<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['nama', 'deskripsi', 'harga', 'gambar', 'kategori_id'];

    public function category()
{
    return $this->belongsTo(Category::class, 'kategori_id');
}

}
