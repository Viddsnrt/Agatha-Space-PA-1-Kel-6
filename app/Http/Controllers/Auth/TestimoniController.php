<?php

// UBAH NAMESPACE JIKA PERLU (MISAL KE App\Http\Controllers\User)
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimoni; // UBAH PENGGUNAAN MODEL
use Illuminate\Support\Facades\Auth; // Tetap diperlukan jika ada logika terkait user
use Illuminate\Validation\Rule; // Untuk validasi IN

// UBAH NAMA CLASS
class TestimoniController extends Controller
{
    /**
     * Menampilkan halaman Testimoni & Saran (daftar dan form).
     */
    public function list(Request $request)
    {
        // UBAH NAMA VARIABEL LOKAL MENJADI $testimonis
        $testimonis = Testimoni::where('tampilkan', true) // Menggunakan nama variabel $testimonis
                                 ->latest()
                                 ->paginate(9);

        $showForm = ($request->isMethod('post') && session()->has('errors'))
                    || (session()->has('errors') && !empty($request->old()))
                    || $request->query('show_form') === 'true';

        // Sekarang compact akan mengirim variabel dengan nama 'testimonis'
        return view('user.testimoni.index', compact('testimonis', 'showForm'));
    }

    /**
     * Menyimpan testimoni & saran baru dari pengguna.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'no_hp'   => 'nullable|string|max:20|regex:/^[0-9\-\+\s\(\)]*$/',
            'jenis'   => ['required', Rule::in(['testimoni', 'saran'])],
            'pesan'   => 'required|string|min:10|max:2000',
            'gambar'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('testimoni_uploads', 'public');
        }

        Testimoni::create([
            'nama'    => $validatedData['nama'],
            'email'   => $validatedData['email'],
            'no_hp'   => $validatedData['no_hp'],
            'jenis'   => $validatedData['jenis'],
            'pesan'   => $validatedData['pesan'],
            'gambar'  => $gambarPath,
            'tampilkan' => false,
        ]);

        return redirect()->route('testimoni.list')
                         ->with('success_submit', 'Terima kasih! Masukan Anda telah berhasil dikirim dan akan kami review.');
    }
}