<?php

namespace App\Http\Controllers\Auth; // Pastikan namespace benar

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log; // Tambahkan untuk logging error

class CartController extends Controller
{
    /**
     * Menambahkan item ke keranjang (biasanya dari halaman menu).
     */
    public function add(Request $request, $id)
    {
        try {
            // Validasi dasar (opsional tapi bagus)
            $menu = Menu::findOrFail($id);
            $cart = session()->get('cart', []);

            if (isset($cart[$id])) {
                $cart[$id]['quantity']++;
            } else {
                // Ambil hanya data yang relevan
                $cart[$id] = [
                    "nama" => $menu->nama,
                    "gambar" => $menu->gambar, // Pastikan path gambar benar dan bisa diakses
                    "harga" => $menu->harga,
                    "quantity" => 1
                ];
            }
            session()->put('cart', $cart);
            // Bisa return redirect atau JSON tergantung dari mana request berasal
            // Jika selalu dari halaman menu, redirect lebih umum
            return redirect()->back()->with('success', 'Menu berhasil ditambahkan ke keranjang!');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
             return redirect()->back()->with('error', 'Menu tidak ditemukan.');
        } catch (\Exception $e) {
            Log::error("Error adding to cart: " . $e->getMessage()); // Log error
            return redirect()->back()->with('error', 'Gagal menambahkan menu ke keranjang.');
        }
    }

    /**
     * Menampilkan halaman keranjang.
     */
    public function view()
    {
        // View akan mengambil data cart dari session secara langsung
        return view('user.cart'); // Pastikan path view benar: 'user.cart' atau 'user.cart.index'
    }


    /**
     * Memperbarui kuantitas item di keranjang via AJAX.
     * Menghapus item jika kuantitas menjadi 0 atau kurang.
     */
    public function ajaxUpdate(Request $request)
    {
        // Validasi input dari AJAX
        $validated = $request->validate([
            'id' => 'required', // Pastikan ID ada dan valid jika perlu (misal exists:menus,id)
            'type' => 'required|in:increase,decrease',
        ]);

        $id = $validated['id'];
        $type = $validated['type'];

        try {
            $cart = session()->get('cart', []);

            // Cek jika item ada di keranjang
            if (!isset($cart[$id])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Produk tidak ditemukan di keranjang.'
                ], 404); // Status Not Found
            }

            $newQty = $cart[$id]['quantity']; // Simpan kuantitas baru

            // Update kuantitas
            if ($type === 'increase') {
                $cart[$id]['quantity']++;
                $newQty = $cart[$id]['quantity'];
            } elseif ($type === 'decrease') {
                $cart[$id]['quantity']--;
                $newQty = $cart[$id]['quantity'];

                // Jika kuantitas 0 atau kurang, hapus item dari keranjang
                if ($cart[$id]['quantity'] <= 0) {
                    unset($cart[$id]);
                    $newQty = 0; // Set newQty jadi 0 untuk response JSON
                }
            }

            // Simpan kembali cart ke session
            session()->put('cart', $cart);

            // Kirim response sukses
            return response()->json([
                'success' => true,
                'qty' => $newQty, // Kirim kuantitas terbaru (atau 0 jika dihapus)
                'message' => $newQty > 0 ? 'Kuantitas diperbarui.' : 'Item dihapus dari keranjang.', // Pesan dinamis
                'cart_count' => count($cart), // Jumlah item unik di keranjang
                'cartEmpty' => empty($cart) // Flag apakah keranjang kosong
            ]);

        } catch (\Exception $e) {
            Log::error("Error updating cart via AJAX: " . $e->getMessage());
            return response()->json([
                'success' => false,
                // 'message' => 'Terjadi kesalahan saat memperbarui keranjang.' // Pesan aman untuk production
                 'message' => 'Error: ' . $e->getMessage() // Pesan detail untuk development
            ], 500); // Status Internal Server Error
        }
    }

    /**
     * Menghapus item dari keranjang via AJAX.
     */
    public function ajaxRemove(Request $request) // Pastikan nama method = ajaxRemove
    {
        // Validasi input
         $validated = $request->validate([
            'id' => 'required', // Pastikan ID ada
        ]);
        $id = $validated['id'];

        try {
            $cart = session()->get('cart', []);

            // Cek jika item ada
            if (!isset($cart[$id])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Produk tidak ditemukan di keranjang.'
                ], 404);
            }

            // Hapus item
            unset($cart[$id]);

            // Simpan kembali cart ke session
            session()->put('cart', $cart);

            // Kirim response sukses
            return response()->json([
                'success' => true,
                'message' => 'Item berhasil dihapus dari keranjang.',
                'cart_count' => count($cart), // Jumlah item unik tersisa
                'cartEmpty' => empty($cart) // Flag apakah keranjang kosong
            ]);

        } catch (\Exception $e) {
            Log::error("Error removing item from cart via AJAX: " . $e->getMessage());
            return response()->json([
                'success' => false,
                // 'message' => 'Terjadi kesalahan saat menghapus item.' // Production
                'message' => 'Error: ' . $e->getMessage() // Development
            ], 500);
        }
    }
}