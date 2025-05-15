<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KritikSaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Tidak digunakan di sini, bisa dihapus jika tidak ada rencana
use Illuminate\Support\Str;       // Tidak digunakan di sini, bisa dihapus jika tidak ada rencana

class KritikSaranController extends Controller
{
    /**
     * Menampilkan halaman Kritik & Saran (daftar dan form).
     */
    public function list(Request $request)
    {
  

        $kritikSaran = KritikSaran::where('tampilkan', true)
                                 ->latest()
                                 ->paginate(9);

        // Logika ini sudah benar: form hanya tampil jika ada error validasi DARI FORM INI
        // atau jika ada parameter 'show_form=true'
        $showForm = ($request->isMethod('post') && session()->has('errors')) // Tampil jika ini adalah POST request dengan error (gagal validasi dari form ini)
                    || (session()->has('errors') && !empty($request->old())) // Tampil jika ada error DAN ada old input (menandakan redirect back with errors dari form ini)
                    || $request->query('show_form') === 'true'; // Tampil jika ada parameter show_form

       

        return view('user.kritik_saran.index', compact('kritikSaran', 'showForm'));
    }

    /**
     * Menyimpan kritik & saran baru dari pengguna.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([ // Simpan hasil validasi ke variabel
            'nama'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'no_hp'   => 'required|string|max:20|regex:/^[0-9\-\+\s\(\)]*$/',
            'jenis'   => 'required|in:kritik,saran',
            'pesan'   => 'required|string|min:10|max:2000',
            'gambar'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            // Menggunakan $validatedData untuk memastikan hanya file yang valid yang diproses
            $gambarPath = $request->file('gambar')->store('kritik_saran_uploads', 'public');
        }

        KritikSaran::create([
            'nama'    => $validatedData['nama'],
            'email'   => $validatedData['email'],
            'no_hp'   => $validatedData['no_hp'],
            'jenis'   => $validatedData['jenis'],
            'pesan'   => $validatedData['pesan'],
            'gambar'  => $gambarPath,
            'tampilkan' => false, // Default false, akan direview admin
        ]);

        return redirect()->route('kritik-saran.list')
                         ->with('success_submit', 'Terima kasih! Masukan Anda telah berhasil dikirim dan akan kami review.');
    }
}