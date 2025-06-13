<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimoni; // UBAH PENGGUNAAN MODEL
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

// UBAH NAMA CLASS
class TestimoniController extends Controller
{
    public function index()
    {
        // UBAH MODEL DAN VARIABEL
        $testimonis = Testimoni::latest()->get();
        // UBAH PATH VIEW DAN VARIABEL COMPACT
        return view('admin.testimoni.index', compact('testimonis'));
    }

    public function updateTampilkan($id)
    {
        $testimoni = Testimoni::findOrFail($id); // UBAH MODEL
        $testimoni->tampilkan = !$testimoni->tampilkan;
        $testimoni->save();

        // UBAH PESAN
        return redirect()->back()->with('success', 'Status tampilan testimoni/saran berhasil diperbarui.');
    }

    public function exportPdf()
    {
        $testimonis = Testimoni::latest()->get(); // UBAH MODEL
        $data = [
            'title' => 'Laporan Testimoni & Saran', // UBAH JUDUL
            'date' => date('d/m/Y'),
            'testimonis' => $testimonis // UBAH VARIABEL
        ];

        // UBAH PATH VIEW PDF TEMPLATE DAN NAMA FILE DOWNLOAD
        $pdf = Pdf::loadView('admin.testimoni.pdf_template', $data);
        return $pdf->download('laporan-testimoni-saran-'.date('YmdHis').'.pdf');
    }

    /**
     * Remove the specified resource from storage.
     */
    // UBAH TYPE HINTING MODEL DAN NAMA VARIABEL
    public function destroy(Testimoni $testimoni)
    {
        try {
            if ($testimoni->gambar) {
                // Pastikan path untuk gambar 'testimoni' jika Anda mengubah folder penyimpanan
                Storage::disk('public')->delete($testimoni->gambar);
            }

            $testimoni->delete();

            // UBAH NAMA ROUTE DAN PESAN
            return redirect()->route('admin.testimoni.index')
                             ->with('success', 'Testimoni/Saran berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Error deleting Testimoni: ' . $e->getMessage());
            // UBAH NAMA ROUTE DAN PESAN
            return redirect()->route('admin.testimoni.index')
                             ->with('error', 'Gagal menghapus testimoni/saran. Silakan coba lagi.');
        }
    }
}