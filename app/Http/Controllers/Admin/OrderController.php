<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon; // Import Carbon

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('user')->latest(); // Eager load user

        // Filter berdasarkan pencarian ID atau Nama Pemesan
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('id', 'like', "%{$searchTerm}%")
                  ->orWhere('customer_name', 'like', "%{$searchTerm}%");
            });
        }

        // Contoh Filter berdasarkan Rentang Tanggal Pemesanan (jika menggunakan daterangepicker)
        // if ($request->filled('date_range')) {
        //     $dates = explode(' - ', $request->date_range);
        //     if (count($dates) == 2) {
        //         $startDate = Carbon::createFromFormat('Y-m-d', trim($dates[0]))->startOfDay();
        //         $endDate = Carbon::createFromFormat('Y-m-d', trim($dates[1]))->endOfDay();
        //         $query->whereBetween('created_at', [$startDate, $endDate]);
        //     }
        // }

        // Filter berdasarkan Jam Kedatangan (Contoh jika ingin filter spesifik jam)
        if ($request->filled('filter_jam_kedatangan')) {
            // Asumsi format input adalah HH:MM
            $query->whereTime('jam_kedatangan', $request->filter_jam_kedatangan);
        }


        $orders = $query->paginate(15)->appends($request->query()); // appends untuk menjaga filter saat paginasi

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('items.menu');
        return view('admin.orders.show', compact('order'));
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Pesanan berhasil dihapus.');
    }

    public function downloadPdf(Request $request)
    {
        $query = Order::with('user')->latest();

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('id', 'like', "%{$searchTerm}%")
                  ->orWhere('customer_name', 'like', "%{$searchTerm}%");
            });
        }
        // Anda bisa menambahkan filter lain di sini, sama seperti di method index()
        // if ($request->filled('date_range')) {
        //     // ... logika filter tanggal ...
        // }
        if ($request->filled('filter_jam_kedatangan')) {
            $query->whereTime('jam_kedatangan', $request->filter_jam_kedatangan);
        }


        $data['orders'] = $query->get();
        $data['totalOverall'] = $data['orders']->sum('total_amount');
        $data['filterParams'] = $request->all(); // Kirim semua parameter request ke view PDF

        // Pastikan view 'admin.orders.pdf' sudah ada dan bisa menampilkan 'jam_kedatangan'
        $pdf = Pdf::loadView('admin.orders.pdf', $data);
        $filename = 'laporan-pesanan-' . date('Ymd-His') . '.pdf';
        return $pdf->download($filename);
    }
}