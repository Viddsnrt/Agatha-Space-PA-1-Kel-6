<?php

namespace App\Http\Controllers\Auth; // Pastikan namespace benar

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function add(Request $request, $id)
    {
        try {
            $menu = Menu::findOrFail($id);
            $cart = session()->get('cart', []);

            if(isset($cart[$id])) {
                $cart[$id]['quantity']++;
            } else {
                $cart[$id] = [
                    "nama" => $menu->nama,
                    "gambar" => $menu->gambar,
                    "harga" => $menu->harga,
                    "quantity" => 1
                ];
            }
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Menu berhasil ditambahkan ke keranjang!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan menu: ' . $e->getMessage());
        }
    }

    public function view()
    {
        try {
            // $cart = session()->get('cart', []); // Sudah dihandle di blade
            return view('user.cart'); // Tidak perlu compact('cart') jika sudah diambil di blade
        } catch (\Exception $e) {
            return view('user.cart') // Tidak perlu ['cart' => []]
                ->with('error', 'Gagal memuat keranjang: ' . $e->getMessage());
        }
    }

    // Metode update() yang lama (untuk non-AJAX) bisa kamu hapus jika tidak dipakai lagi
    // public function update(Request $request, $id) { ... }

    // Metode remove() yang lama (untuk non-AJAX) bisa kamu hapus jika tidak dipakai lagi
    // public function remove(Request $request, $id) { ... }

    public function ajaxUpdate(Request $request)
    {
        try {
            $id = $request->id;
            $type = $request->type;
            $cart = session()->get('cart', []);

            if (!isset($cart[$id])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Produk tidak ditemukan di keranjang'
                ], 404); // Beri status code yang sesuai
            }

            $currentQty = $cart[$id]['quantity'];

            if ($type === 'increase') {
                $cart[$id]['quantity']++;
            } elseif ($type === 'decrease') {
                $cart[$id]['quantity']--;
                if ($cart[$id]['quantity'] < 1) { // Jika kuantitas jadi 0 atau kurang
                    unset($cart[$id]); // Hapus item dari keranjang
                }
            } else {
                 return response()->json([
                    'success' => false,
                    'message' => 'Tipe operasi tidak valid.'
                ], 400);
            }

            session()->put('cart', $cart);

            return response()->json([
                'success' => true,
                'qty' => $cart[$id]['quantity'] ?? 0, // Kirim 0 jika item dihapus
                'cart_count' => count($cart),
                'message' => 'Keranjang berhasil diperbarui.'
            ]);
        } catch (\Exception $e) {
            // Log error $e->getMessage()
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server: ' . $e->getMessage() // Lebih deskriptif saat development
                // 'message' => 'Terjadi kesalahan saat memperbarui keranjang.' // Untuk production
            ], 500);
        }
    }

    public function ajaxRemove(Request $request) // Ubah nama menjadi ajaxRemove agar konsisten dengan route
    {
        try {
            $id = $request->id;
            $cart = session()->get('cart', []);

            if (!isset($cart[$id])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Produk tidak ditemukan di keranjang'
                ], 404);
            }

            unset($cart[$id]);
            session()->put('cart', $cart);

            return response()->json([
                'success' => true,
                'cart_count' => count($cart),
                'message' => 'Item berhasil dihapus dari keranjang.'
            ]);
        } catch (\Exception $e) {
            // Log error $e->getMessage()
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server: ' . $e->getMessage()
                // 'message' => 'Terjadi kesalahan saat menghapus item.' // Untuk production
            ], 500);
        }
    }
}