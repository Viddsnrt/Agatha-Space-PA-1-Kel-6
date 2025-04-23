<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KritikSaran;

class KritikSaranController extends Controller
{
    public function index()
{$kritiksarans = KritikSaran::latest()->get();
    return view('admin.kritik-saran.index', compact('kritiksarans'));

    
}

public function updateTampilkan($id)
{
    $kritikSaran = KritikSaran::findOrFail($id);
    $kritikSaran->tampilkan = !$kritikSaran->tampilkan; // toggle antara true/false
    $kritikSaran->save();

    return redirect()->back()->with('success', 'Status tampilan berhasil diperbarui.');
}

}
