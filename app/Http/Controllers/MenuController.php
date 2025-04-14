<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Kategori;

class MenuController extends Controller
{
    // Tampilkan semua menu di halaman user (dibagi berdasarkan kategori)
    public function index()
    {
        $makanan = Menu::whereHas('kategori', function ($query) {
            $query->whereRaw("LOWER(nama) = 'makanan'");
        })->get();

        $minuman = Menu::whereHas('kategori', function ($query) {
            $query->whereRaw("LOWER(nama) = 'minuman'");
        })->get();

        return view('menu', compact('makanan', 'minuman'));
    }

    // Tampilkan form tambah menu
    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.menu.create', compact('kategoris'));
    }

    // Simpan menu baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        Menu::create($request->all());

        return redirect()->route('menus.index')->with('success', 'Menu berhasil ditambahkan!');
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $kategoris = Kategori::all();
        return view('admin.menu.edit', compact('menu', 'kategoris'));
    }

    // Simpan perubahan
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        $menu = Menu::findOrFail($id);
        $menu->update($request->all());

        return redirect()->route('menus.index')->with('success', 'Menu berhasil diperbarui!');
    }

    // Hapus menu
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return redirect()->route('menus.index')->with('success', 'Menu berhasil dihapus!');
    }
}

