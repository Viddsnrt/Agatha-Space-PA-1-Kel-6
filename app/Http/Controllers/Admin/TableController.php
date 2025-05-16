<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Table; // Pastikan model di-import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Untuk mengelola file

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tables = Table::latest()->get(); // Mengambil data terbaru dulu
        return view('admin.table.index', compact('tables'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.table.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'meja' => 'required|string|max:100|unique:tables,meja', // Tambahkan unique jika nama meja harus unik
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp', // Tambahkan webp jika didukung
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('meja', 'public');
        }

        Table::create([
            'meja' => $request->meja,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('admin.table.index')->with('success', 'Data meja berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Table $table) // Menggunakan Route Model Binding
    {
        // $table = Table::findOrFail($id); // Tidak perlu lagi jika menggunakan Route Model Binding
        return view('admin.table.edit', compact('table'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Table $table) // Menggunakan Route Model Binding
    {
        $request->validate([
            // Validasi unique di-ignore untuk ID saat ini
            'meja' => 'required|string|max:100|unique:tables,meja,' . $table->id,
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp',
        ]);

        // $table = Table::findOrFail($id); // Tidak perlu lagi

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($table->gambar) {
                Storage::disk('public')->delete($table->gambar);
            }
            // Upload gambar baru
            $table->gambar = $request->file('gambar')->store('meja', 'public');
        }

        $table->meja = $request->meja;
        $table->save();

        return redirect()->route('admin.table.index')->with('success', 'Data meja berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Table $table) // Menggunakan Route Model Binding
    {
        // $table = Table::findOrFail($id); // Tidak perlu lagi

        // Hapus gambar jika ada
        if ($table->gambar) {
            Storage::disk('public')->delete($table->gambar);
        }
        $table->delete();

        return redirect()->route('admin.table.index')->with('success', 'Data meja berhasil dihapus.');
    }
}