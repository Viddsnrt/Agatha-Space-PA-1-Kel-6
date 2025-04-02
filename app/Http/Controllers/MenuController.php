<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index()
    {
        // Ambil data makanan dan minuman berdasarkan kategori
        $makanan = Menu::whereRaw("LOWER(kategori) = 'makanan'")->get();
        $minuman = Menu::whereRaw("LOWER(kategori) = 'minuman'")->get();

        // Kirim ke view
        return view('menu', compact('makanan', 'minuman'));
    }
}
