<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationPublicController extends Controller
{
    // Tampilkan semua meja (untuk user)
    public function daftar()
    {
        $meja = Reservation::all();
        return view('user.reservasi', compact('meja'));
    }

    // Kirim ke WhatsApp
    public function kirim(Request $request)
    {
        $request->validate([
            'nama_pemesan' => 'required|string|max:255',
            'meja' => 'required|string|max:100',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'durasi' => 'required|string',
            'catatan' => 'nullable|string',
        ]);

        // Format pesan
        $pesan = "*Reservasi Meja*%0A"
            . "Nama: {$request->nama_pemesan}%0A"
            . "Meja: {$request->meja}%0A"
            . "Tanggal: {$request->tanggal}%0A"
            . "Jam: {$request->jam}%0A"
            . "Durasi: {$request->durasi} jam%0A"
            . "Catatan: " . ($request->catatan ?? '-') . "%0A";

        // Nomor tujuan WhatsApp (ganti sesuai kebutuhan)
        $nomorWA = '628979598744';

        return redirect()->away("https://wa.me/{$nomorWA}?text={$pesan}");
    }
}
