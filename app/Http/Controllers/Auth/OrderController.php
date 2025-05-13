<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'nullable|string|max:20',
            'payment_method' => 'required|string|max:50',
            'notes' => 'nullable|string',
            'order_summary_text_wa' => 'required|string', // Ini dari hidden input
            'total_amount_for_db' => 'required|numeric|min:0', // Ini dari hidden input
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return response()->json(['success' => false, 'message' => 'Keranjang Anda kosong.'], 400);
        }

        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => Auth::id(), // Akan null jika tidak login
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'payment_method' => $request->payment_method,
                'total_amount' => $request->total_amount_for_db,
                'notes' => $request->notes,
                'status' => 'pending', // Status awal
                'order_details_text' => $request->order_summary_text_wa, // Simpan ringkasan WA
                'whatsapp_message_sent' => true, // Asumsi akan dikirim setelah ini
            ]);

            foreach ($cart as $id => $details) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $id, // Asumsi ID di cart adalah menu_id
                    'menu_name' => $details['nama'],
                    'quantity' => $details['quantity'],
                    'price_at_order' => $details['harga'],
                    'subtotal' => $details['quantity'] * $details['harga'],
                ]);
            }

            DB::commit();

            // Kosongkan keranjang setelah pesanan berhasil dibuat
            session()->forget('cart');

            return response()->json([
                'success' => true,
                'message' => 'Pesanan Anda berhasil dibuat dan akan diarahkan ke WhatsApp.',
                'order_id' => $order->id
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error placing order: " . $e->getMessage() . " - Stack: " . $e->getTraceAsString());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memproses pesanan Anda. Silakan coba lagi. Error: ' . $e->getMessage() // Hapus detail error di production
            ], 500);
        }
    }
}