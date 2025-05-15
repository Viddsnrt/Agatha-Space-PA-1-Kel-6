<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; // Jika belum ada, tambahkan untuk Str::limit jika masih digunakan di index

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $query = Menu::with('category')->latest();

        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('nama', 'like', '%' . $searchTerm . '%')
                  ->orWhere('deskripsi', 'like', '%' . $searchTerm . '%');
            });
        }

        // Jika Anda MENGHAPUS pagination dari index.blade.php, maka get() sudah benar.
        // Jika Anda INGIN pagination, gunakan ->paginate(10) atau jumlah yang diinginkan.
        $menus = $query->get(); // atau $query->paginate(10);

        $categories = Category::orderBy('nama')->get();

        // Kirim juga request ke view agar filter tetap aktif di link pagination jika menggunakan paginate()
        // return view('admin.menu.index', compact('menus', 'categories', 'request'));
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
            'nama' => 'required|string|max:255|unique:menus,nama', // Tambah unique jika nama menu harus unik
            'deskripsi' => 'required|string',
            'harga' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'kategori_id' => 'required|exists:categories,id'
        ]);

        $hargaClean = preg_replace('/[^\d]/', '', $request->harga);
        if (!is_numeric($hargaClean) || $hargaClean < 0) {
             return back()->withInput()->withErrors(['harga' => 'Format harga tidak valid atau harga negatif. Pastikan hanya angka yang dimasukkan.']);
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

    public function edit(Menu $menu) // Route Model Binding
    {
        $categories = Category::orderBy('nama')->get();
        return view('admin.menu.edit', compact('menu', 'categories'));
    }

    public function update(Request $request, Menu $menu) // Route Model Binding
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:menus,nama,' . $menu->id, // Unique kecuali untuk ID saat ini
            'deskripsi' => 'required|string',
            'harga' => 'required|string',
            'kategori_id' => 'required|exists:categories,id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $data = $request->only('nama', 'deskripsi', 'kategori_id');

        $hargaClean = preg_replace('/[^\d]/', '', $request->harga);
        if (!is_numeric($hargaClean) || $hargaClean < 0) {
             return back()->withInput()->withErrors(['harga' => 'Format harga tidak valid atau harga negatif. Pastikan hanya angka yang dimasukkan.']);
        }
        $data['harga'] = $hargaClean;

        if ($request->hasFile('gambar')) {
            if ($menu->gambar && Storage::disk('public')->exists($menu->gambar)) {
                Storage::disk('public')->delete($menu->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('menus', 'public');
        }

        $menu->update($data);

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy(Menu $menu) // Route Model Binding
    {
        if ($menu->gambar && Storage::disk('public')->exists($menu->gambar)) {
            Storage::disk('public')->delete($menu->gambar);
        }
        $menu->delete();
        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil dihapus.');
    }
}