<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TableController extends Controller
{
    public function index()
    {
        $tables = Table::all();
        return view('admin.table.index', compact('tables'));
    }

    public function create()
    {
        return view('admin.table.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'meja' => 'required|string|max:100',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
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

    public function edit($id)
    {
        $table = Table::findOrFail($id);
        return view('admin.table.edit', compact('table'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'meja' => 'required|string|max:100',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $table = Table::findOrFail($id);

        if ($request->hasFile('gambar')) {
            if ($table->gambar) {
                Storage::disk('public')->delete($table->gambar);
            }
            $table->gambar = $request->file('gambar')->store('meja', 'public');
        }

        $table->meja = $request->meja;
        $table->save();

        return redirect()->route('admin.table.index')->with('success', 'Data meja berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $table = Table::findOrFail($id);
        if ($table->gambar) {
            Storage::disk('public')->delete($table->gambar);
        }
        $table->delete();

        return redirect()->route('admin.table.index')->with('success', 'Data meja berhasil dihapus.');
    }
}
