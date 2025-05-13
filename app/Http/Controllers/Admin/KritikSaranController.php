<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KritikSaran;
use Barryvdh\DomPDF\Facade\Pdf; // Pertahankan ini untuk PDF

class KritikSaranController extends Controller
{
    public function index()
    {
        $kritiksarans = KritikSaran::latest()->get();
        return view('admin.kritik-saran.index', compact('kritiksarans'));
    }

    public function updateTampilkan($id)
    {
        $kritikSaran = KritikSaran::findOrFail($id);
        $kritikSaran->tampilkan = !$kritikSaran->tampilkan; // toggle antara true/false
        $kritikSaran->save();

        return redirect()->back()->with('success', 'Status tampilan berhasil diperbarui.');
    }

    // Method untuk Export PDF
    public function exportPdf()
    {
        $kritiksarans = KritikSaran::latest()->get();
        $data = [
            'title' => 'Laporan Kritik & Saran',
            'date' => date('d/m/Y'),
            'kritiksarans' => $kritiksarans
        ];

        // Pastikan view 'admin.kritik-saran.pdf_template.blade.php' sudah ada
        $pdf = Pdf::loadView('admin.kritik-saran.pdf_template', $data);
        return $pdf->download('laporan-kritik-saran-'.date('YmdHis').'.pdf');
    }
}