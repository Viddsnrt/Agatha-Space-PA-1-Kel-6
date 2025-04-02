<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    public function index()
    {
        $meja = Meja::all(); // Mengambil semua data meja dari database
        return view('reservasi', compact('meja')); // Kirim data ke view
    }
}

