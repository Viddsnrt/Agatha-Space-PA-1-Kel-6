<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KritikSaran;
use Illuminate\Support\Facades\Auth; // Pastikan ini di-import
use Illuminate\Support\Facades\Storage;

class KritikSaranController extends Controller
{
    /**
     * Menampilkan form untuk membuat kritik/saran BARU,
     * dan juga menampilkan daftar kritik/saran yang sudah ada (jika view 'create' Anda memang didesain untuk itu).
     * Method ini akan dipanggil oleh rute yang mengarah ke halaman form.
     */
    public function create()
    {
        // Ambil kritik & saran yang 'tampilkan' == true (atau 1) untuk ditampilkan di halaman yang sama dengan form
        // Jika view 'user.kritik-saran.create' Anda hanya berisi form, baris ini tidak perlu
        // dan compact('kritikSaran') juga tidak perlu.
        // Namun, jika view 'create' Anda juga menampilkan daftar, maka ini diperlukan.
        $kritikSaran = KritikSaran::where('tampilkan', true) // Gunakan true jika tipe data boolean
                                 ->orderByDesc('created_at')
                                 ->paginate(6); // Gunakan paginate jika daftarnya panjang

        // Pastikan path view 'user.kritik-saran.create' sudah benar
        return view('user.kritik-saran.create', compact('kritikSaran'));
    }

    /**
     * Menyimpan kritik & saran baru dari pengguna.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'no_hp'   => 'required|string|max:20|regex:/^[0-9\-\+\s\(\)]*$/', // Lebih baik string + regex
            'jenis'   => 'required|in:kritik,saran',
            'pesan'   => 'required|string|min:10|max:2000', // Tambahkan min dan max
            'gambar'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // Max 5MB, tambahkan mimes
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('kritik_saran', 'public');
        }

        KritikSaran::create([
            'user_id' => Auth::id(), // Simpan ID user yang login
            'nama'    => $request->nama,
            'email'   => $request->email,
            'no_hp'   => $request->no_hp,
            'jenis'   => $request->jenis,
            'pesan'   => $request->pesan,
            'gambar'  => $gambarPath,
            'tampilkan' => false, // Defaultnya tidak ditampilkan, perlu approval admin
        ]);

        // Redirect kembali ke halaman form create dengan pesan sukses
        // Atau bisa juga redirect ke halaman daftar jika Anda punya halaman daftar terpisah
        return redirect()->route('kritik-saran.create') // Pastikan rute 'kritik-saran.create' ada
                         ->with('success_form', 'Terima kasih! Kritik dan saran Anda telah berhasil dikirim dan akan kami review.');
                         // 'success_form' agar bisa dibedakan jika ada pesan sukses lain di halaman list
    }

    /**
     * Menampilkan daftar kritik & saran yang disetujui (jika Anda memiliki halaman daftar terpisah).
     * Method ini akan dipanggil oleh rute yang mengarah ke halaman daftar.
     */
    public function list() // Atau bisa dinamai index() jika mengikuti konvensi
    {
        $kritikSaran = KritikSaran::where('tampilkan', true) // Gunakan true jika tipe data boolean
                                 ->orderByDesc('created_at')
                                 ->paginate(9); // Gunakan paginate untuk daftar yang panjang

        // Pastikan path view 'user.kritik-saran.index' sudah benar
        return view('user.kritik-saran.index', compact('kritikSaran'));
    }
}