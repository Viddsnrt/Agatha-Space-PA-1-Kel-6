<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $query = Menu::with('category')->latest();

        // Filter berdasarkan kategori
        if ($request->filled('kategori_id')) { // Lebih baik menggunakan filled() untuk mengecek apakah ada isinya
            $query->where('kategori_id', $request->kategori_id);
        }

        // Filter berdasarkan pencarian (nama atau deskripsi)
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('nama', 'like', '%' . $searchTerm . '%')
                  ->orWhere('deskripsi', 'like', '%' . $searchTerm . '%');
                // Jika ingin mencari berdasarkan nama kategori juga (opsional):
                // ->orWhereHas('category', function ($catQuery) use ($searchTerm) {
                //     $catQuery->where('nama', 'like', '%' . $searchTerm . '%');
                // });
            });
        }

        // Menggunakan paginate untuk mendapatkan hasil paginasi
        $menus = $query->get(); // Ganti 10 dengan jumlah item per halaman yang Anda inginkan

        $categories = Category::orderBy('nama')->get(); // Lebih baik diurutkan agar tampilan dropdown rapi

        return view('admin.menu.index', compact('menus', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('nama')->get();
        return view('admin.menu.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|string', // Validasi sebagai string dulu karena ada "Rp"
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Tambahkan batasan tipe dan ukuran file
            'kategori_id' => 'required|exists:categories,id'
        ]);

        // Bersihkan harga (hapus "Rp", titik, spasi)
        $hargaClean = preg_replace('/[^\d]/', '', $request->harga);
        if (!is_numeric($hargaClean) || $hargaClean < 0) {
             return back()->withInput()->withErrors(['harga' => 'Format harga tidak valid atau harga negatif.']);
        }


        $gambarPath = $request->file('gambar')->store('menus', 'public');

        Menu::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $hargaClean,
            'gambar' => $gambarPath,
            'kategori_id' => $request->kategori_id,
        ]);

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit(Menu $menu)
    {
        $categories = Category::orderBy('nama')->get();
        return view('admin.menu.edit', compact('menu', 'categories'));
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|string', // Validasi sebagai string dulu
            'kategori_id' => 'required|exists:categories,id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Tambahkan batasan tipe dan ukuran file
        ]);

        $data = $request->only('nama', 'deskripsi', 'kategori_id');

        // Bersihkan harga (hapus "Rp", titik, spasi)
        $hargaClean = preg_replace('/[^\d]/', '', $request->harga);
        if (!is_numeric($hargaClean) || $hargaClean < 0) {
             return back()->withInput()->withErrors(['harga' => 'Format harga tidak valid atau harga negatif.']);
        }
        $data['harga'] = $hargaClean;


        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($menu->gambar && Storage::disk('public')->exists($menu->gambar)) {
                Storage::disk('public')->delete($menu->gambar);
            }
            // Simpan gambar baru
            $data['gambar'] = $request->file('gambar')->store('menus', 'public');
        }

        $menu->update($data);

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy(Menu $menu)
    {
        // Hapus gambar jika ada
        if ($menu->gambar && Storage::disk('public')->exists($menu->gambar)) {
            Storage::disk('public')->delete($menu->gambar);
        }

        $menu->delete();

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil dihapus.');
    }
}