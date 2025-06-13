<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Order;
use App\Models\OrderItem; // Pastikan model ini ada dan digunakan dengan benar

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        // Validasi input, termasuk jam_kedatangan
        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'nullable|string|max:20|regex:/^[0-9\-\+\s\(\)]*$/', // Regex lebih fleksibel
            'jam_kedatangan' => 'required|date_format:H:i', // Validasi format jam (HH:MM)
            'payment_method' => 'required|string|max:50', // Sesuaikan panjang max jika perlu
            'notes' => 'nullable|string|max:1000', // Batasi panjang catatan
            // 'order_summary_text_wa' => 'required|string', // Hapus jika tidak digunakan lagi, atau buat nullable
            'total_amount_for_db' => 'required|numeric|min:0',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return response()->json(['success' => false, 'message' => 'Keranjang Anda kosong.'], 400);
        }

        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => Auth::id(),
                'customer_name' => $validatedData['customer_name'],
                'customer_phone' => $validatedData['customer_phone'],
                'payment_method' => $validatedData['payment_method'],
                'total_amount' => $validatedData['total_amount_for_db'],
                'notes' => $validatedData['notes'],
                'jam_kedatangan' => $validatedData['jam_kedatangan'], // SIMPAN JAM KEDATANGAN
                // 'status' => 'pending', // DIHAPUS
                // Jika order_summary_text_wa masih dibutuhkan, pastikan dikirim dari form atau generate di sini
                'order_details_text' => $request->input('order_summary_text_wa', $this->generateOrderDetailsText($cart, $validatedData['total_amount_for_db'])),
                'whatsapp_message_sent' => true, // Asumsi akan dikirim, bisa diubah logikanya
            ]);

            foreach ($cart as $id => $details) {
                // Pastikan $id adalah menu_id yang valid
                if (!isset($details['nama']) || !isset($details['quantity']) || !isset($details['harga'])) {
                    Log::warning("Skipping invalid cart item during order creation: Menu ID " . $id);
                    continue; // Lewati item yang tidak lengkap
                }
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $id,
                    'menu_name' => $details['nama'],
                    'quantity' => $details['quantity'],
                    'price_at_order' => $details['harga'],
                    'subtotal' => $details['quantity'] * $details['harga'],
                ]);
            }

            DB::commit();
            session()->forget('cart'); // Kosongkan keranjang

            return response()->json([
                'success' => true,
                'message' => 'Pesanan Anda berhasil dibuat dan akan diarahkan ke WhatsApp.',
                'order_id' => $order->id
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            Log::error("Validation error placing order: " . $e->getMessage() . " - Errors: " . json_encode($e->errors()));
            return response()->json([
                'success' => false,
                'message' => 'Data yang Anda masukkan tidak valid. Mohon periksa kembali.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error placing order: " . $e->getMessage() . " - Stack: " . $e->getTraceAsString() . " - Data: " . json_encode($request->all()));
            return response()->json([
                'success' => false,
                // Pesan error yang lebih umum untuk produksi
                'message' => 'Terjadi kesalahan saat memproses pesanan Anda. Silakan coba lagi atau hubungi dukungan.'
                // 'message' => 'Terjadi kesalahan: ' . $e->getMessage() // Detail error untuk development
            ], 500);
        }
    }

    // Helper function untuk membuat teks detail order jika order_summary_text_wa tidak dikirim dari form
    private function generateOrderDetailsText(array $cart, $totalAmount)
    {
        $detailsText = "Detail Pesanan:\n";
        foreach ($cart as $item) {
            $subtotal = $item['harga'] * $item['quantity'];
            $detailsText .= "- {$item['nama']} ({$item['quantity']}x) = Rp " . number_format($subtotal, 0, ',', '.') . "\n";
        }
        $detailsText .= "\nTotal Keseluruhan: Rp " . number_format($totalAmount, 0, ',', '.');
        return $detailsText;
    }
}