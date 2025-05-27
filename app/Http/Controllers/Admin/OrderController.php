<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use PDF; // Import class PDF dari package dompdf

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('items.menu');
        return view('admin.orders.show', compact('order'));
    }

    // Hapus atau komentari method updateStatus jika sudah tidak digunakan
    // public function updateStatus(Request $request, Order $order)
    // {
    //     $request->validate(['status' => 'required|in:pending,processing,completed,cancelled,on_delivery']);
    //     $order->update(['status' => $request->status]);
    //     return redirect()->route('admin.orders.show', $order)->with('success', 'Status pesanan berhasil diperbarui.');
    // }

    public function destroy(Order $order)
    {
        $order->items()->delete();
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Pesanan berhasil dihapus.');
    }

    /**
     * Generate PDF Laporan Pesanan.
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadPdf(Request $request) // Tambahkan Request jika ingin filter
    {
        // Untuk saat ini, kita ambil semua pesanan.
        // Nanti bisa ditambahkan filter berdasarkan tanggal, status, dll.
        // Contoh: $orders = Order::query();
        // if ($request->has('start_date') && $request->start_date) {
        //     $orders->whereDate('created_at', '>=', $request->start_date);
        // }
        // if ($request->has('end_date') && $request->end_date) {
        //     $orders->whereDate('created_at', '<=', $request->end_date);
        // }
        // $data['orders'] = $orders->with('user')->latest()->get();

        $data['orders'] = Order::with('user')->latest()->get(); // Ambil semua pesanan, tidak dipaginasi
        $data['totalOverall'] = $data['orders']->sum('total_amount');


        $pdf = PDF::loadView('admin.orders.pdf', $data);
        
        // Ukuran kertas dan orientasi (opsional)
        // $pdf->setPaper('a4', 'portrait'); // 'portrait' atau 'landscape'

        $filename = 'laporan-pesanan-' . date('Ymd-His') . '.pdf';
        
        // return $pdf->stream($filename); // Untuk menampilkan di browser
        return $pdf->download($filename); // Untuk langsung download
    }
}