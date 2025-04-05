<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MejaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('mejas')->insert([
            [
                'nama' => 'Meja Indoor',
                'kapasitas' => 4,
                'harga' => 50000,
                'gambar' => 'indoor.jpg'
            ],
            [
                'nama' => 'Meja Outdoor',
                'kapasitas' => 2,
                'harga' => 70000,
                'gambar' => 'outdoor.jpg'
            ],
            [
                'nama' => 'Meja nature',
                'kapasitas' => 4,
                'harga' => 30000,
                'gambar' => 'nature.jpg'
            ],
        ]);
    }
}
