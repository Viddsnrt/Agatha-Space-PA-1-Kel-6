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

        if ($request->has('kategori_id') && $request->kategori_id != '') {
            $query->where('kategori_id', $request->kategori_id);
        }

        $menus = $query->get();
        $categories = Category::all();

        return view('admin.menu.index', compact('menus', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.menu.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'gambar' => 'required|image',
            'kategori_id' => 'required|exists:categories,id'
        ]);

        // Bersihkan harga (hapus "Rp", titik, spasi)
        $harga = preg_replace('/\D/', '', $request->harga);

        $gambar = $request->file('gambar')->store('menus', 'public');

        Menu::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $harga,
            'gambar' => $gambar,
            'kategori_id' => $request->kategori_id,
        ]);

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit(Menu $menu)
    {
        $categories = Category::all();
        return view('admin.menu.edit', compact('menu', 'categories'));
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'kategori_id' => 'required|exists:categories,id',
            'gambar' => 'nullable|image',
        ]);

        $data = $request->only('nama', 'deskripsi', 'kategori_id');

        // Bersihkan harga (hapus "Rp", titik, spasi)
        $data['harga'] = preg_replace('/\D/', '', $request->harga);

        if ($request->hasFile('gambar')) {
            if ($menu->gambar) {
                Storage::disk('public')->delete($menu->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('menus', 'public');
        }

        $menu->update($data);

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy(Menu $menu)
    {
        if ($menu->gambar) {
            Storage::disk('public')->delete($menu->gambar);
        }

        $menu->delete();

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil dihapus.');
    }
}
