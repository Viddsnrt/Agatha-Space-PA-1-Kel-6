<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KritikSaran;
use Illuminate\Support\Facades\Storage;

class KritikSaranController extends Controller
{
    // Tampilkan form create sekaligus daftar kritik & saran yang disetujui
    public function create()
    {
        $kritikSaran = KritikSaran::where('tampilkan', 1)->latest()->get();
        return view('user.kritik_saran.create', compact('kritikSaran'));
    }

    // Simpan kritik & saran dari user
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'no_hp'   => 'required|numeric',
            'jenis'   => 'required|in:kritik,saran',
            'pesan'   => 'required|string|max:1000',
            'gambar'  => 'nullable|image|max:2048',
        ]);

        // Upload gambar jika ada
        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('kritik_saran', 'public');
        }

        // Simpan data ke database
        KritikSaran::create([
            'nama'    => $request->nama,
            'email'   => $request->email,
            'no_hp'   => $request->no_hp,
            'jenis'   => $request->jenis,
            'pesan'   => $request->pesan,
            'gambar'  => $gambarPath,
        ]);

        return redirect()->route('kritik-saran.create')->with('success', 'Kritik atau saran Anda berhasil dikirim!');
    }

    // (Opsional) Halaman list terpisah jika dibutuhkan
    public function list()
    {
        $kritikSaran = KritikSaran::where('tampilkan', 1)->latest()->get();
        return view('user.kritik_saran.index', compact('kritikSaran'));
    }
}
