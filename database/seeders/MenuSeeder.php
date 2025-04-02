<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    public function run()
    {
        DB::table('menus')->insert([
            ['nama' => 'Kopi Hitam', 'deskripsi' => 'Kopi asli tanpa gula', 'harga' => 10000, 'gambar' => 'kopi.jpg'],
            ['nama' => 'Latte', 'deskripsi' => 'Kopi dengan susu', 'harga' => 15000, 'gambar' => 'latte.jpg']
        ]);
    }
}
