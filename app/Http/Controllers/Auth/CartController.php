<?php

namespace App\Http\Controllers\Auth; // Pastikan namespace benar

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class CartController extends Controller
{
    /**
     * Jika semua method di controller ini membutuhkan autentikasi (kecuali mungkin 'add' jika masih ada).
     * Anda bisa menambahkan middleware di constructor.
     * Namun, karena 'ajaxAdd' sudah dilindungi middleware di route, ini mungkin tidak perlu
     * kecuali jika 'view', 'ajaxUpdate', 'ajaxRemove' juga selalu butuh auth (yang mana biasanya iya).
     * Jika Anda sudah mengatur middleware di route, itu sudah cukup.
     */
    // public function __construct()
    // {
    //     $this->middleware('auth'); // Ini akan berlaku untuk SEMUA method di controller ini
    // }

    /**
     * Menambahkan item ke keranjang (via form submit biasa - JIKA MASIH DIPAKAI).
     * Biasanya dipanggil dari halaman menu jika tidak menggunakan AJAX.
     * Route: POST /cart/add/{id}
     */
    public function add(Request $request, $id)
    {
        // Metode ini mungkin tidak lagi digunakan jika Anda sepenuhnya beralih ke AJAX
        // untuk penambahan dari halaman menu.
        try {
            $menu = Menu::findOrFail($id);
            $cart = session()->get('cart', []);

            if (isset($cart[$id])) {
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

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
             return redirect()->back()->with('error', 'Menu tidak ditemukan.');
        } catch (\Exception $e) {
            Log::error("Error adding to cart (form submit): " . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menambahkan menu ke keranjang.');
        }
    }

    /**
     * Menampilkan halaman keranjang/checkout.
     * Route: GET /cart (biasanya dilindungi middleware 'auth')
     */
    public function view()
    {
        // Ambil data keranjang dari session
        $cart = session()->get('cart', []);

        // Berdasarkan diskusi sebelumnya, Anda menggunakan 'user.checkout' untuk tampilan keranjang.
        // Jika nama viewnya 'user.cart', ganti 'user.checkout' menjadi 'user.cart'.
        return view('user.cart', compact('cart'));
    }

    /**
     * Menambahkan item ke keranjang via AJAX.
     * Dipanggil dari halaman menu jika user SUDAH LOGIN.
     * Jika belum login, LoginController akan menangani penambahan setelah login.
     * Route: POST /cart/ajax-add (dilindungi middleware 'auth')
     */
    public function ajaxAdd(Request $request)
    {
        // Middleware 'auth' pada route ini sudah memastikan user terautentikasi.
        try {
            $validated = $request->validate([
                'menu_id' => 'required|exists:menus,id', // Pastikan menu_id valid dan ada di tabel menus
            ]);

            $menuId = $validated['menu_id'];
            $menu = Menu::findOrFail($menuId); // Ambil detail menu
            $cart = session()->get('cart', []);

            // Logika tambah atau beri notifikasi jika sudah ada
            if (isset($cart[$menuId])) {
                // Opsi 1: Increment quantity jika sudah ada (sesuai kode Anda sebelumnya)
                // $cart[$menuId]['quantity']++;
                // session()->put('cart', $cart);
                // return response()->json([
                //     'success' => true,
                //     'message' => $menu->nama . ' jumlahnya ditambah di keranjang.',
                //     'cartCount' => count($cart)
                // ]);

                // Opsi 2: Beri tahu pengguna bahwa item sudah ada (tidak dianggap error)
                // Ini mungkin lebih sesuai dengan alur "tambah" yang biasanya berarti item baru
                // atau setidaknya notifikasi yang berbeda jika sudah ada.
                return response()->json([
                    'success' => true, // Atau false jika Anda ingin JS menanggapinya sebagai 'gagal' menambahkan baru
                    'message' => $menu->nama . ' sudah ada di keranjang Anda.',
                    'cartCount' => count($cart) // Tetap kirim cartCount
                ]);

            } else {
                // Item belum ada, tambahkan baru
                $cart[$menuId] = [
                    "nama" => $menu->nama,
                    "gambar" => $menu->gambar, // Pastikan path/nama field gambar sesuai model Menu Anda
                    "harga" => $menu->harga,
                    "quantity" => 1
                    // Anda bisa menambahkan field lain yang relevan di sini,
                    // misalnya 'id' => $menu->id, jika $menuId sebagai key array tidak cukup.
                ];
                session()->put('cart', $cart);

                // Kirim response sukses
                return response()->json([
                    'success' => true,
                    'message' => $menu->nama . ' berhasil ditambahkan ke keranjang!',
                    'cartCount' => count($cart) // Kirim jumlah item unik
                ]);
            }

        } catch (ValidationException $e) {
             return response()->json([
                'success' => false,
                'message' => 'Data tidak valid.', // Pesan umum
                'errors' => $e->errors(), // Detail error validasi (berguna untuk debug di client)
            ], 422); // Status Unprocessable Entity
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Menu yang dipilih tidak ditemukan.' // Pesan lebih user-friendly
            ], 404); // Status Not Found
        } catch (\Exception $e) {
            Log::error("Error adding item to cart via AJAX: " . $e->getMessage() . " - Payload: " . json_encode($request->all()));
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan internal saat menambahkan item ke keranjang.' // Production message
                // 'message' => 'Error: ' . $e->getMessage() // Untuk development
            ], 500); // Status Internal Server Error
        }
    }


    /**
     * Memperbarui kuantitas item di keranjang via AJAX.
     * Dipanggil dari halaman keranjang/checkout.
     * Route: POST /cart/update (dilindungi middleware 'auth')
     */
    public function ajaxUpdate(Request $request)
    {
        // Validasi input dari AJAX
        $validated = $request->validate([
            'id' => 'required', // ID Item di keranjang (yang merupakan menu_id)
            'type' => 'required|in:increase,decrease',
        ]);

        $id = $validated['id']; // Ini adalah menu_id yang menjadi key di array cart
        $type = $validated['type'];

        try {
            $cart = session()->get('cart', []);

            if (!isset($cart[$id])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Produk tidak ditemukan di keranjang.'
                ], 404);
            }

            $currentQty = $cart[$id]['quantity'];
            $newQty = $currentQty; // Inisialisasi

            if ($type === 'increase') {
                $cart[$id]['quantity']++;
                $newQty = $cart[$id]['quantity'];
            } elseif ($type === 'decrease') {
                $cart[$id]['quantity']--;
                $newQty = $cart[$id]['quantity'];

                if ($cart[$id]['quantity'] <= 0) {
                    unset($cart[$id]); // Hapus item jika kuantitas 0 atau kurang
                    $newQty = 0; // Set newQty menjadi 0 karena item dihapus
                }
            }

            session()->put('cart', $cart);

            return response()->json([
                'success' => true,
                'qty' => $newQty, // Kuantitas baru item (atau 0 jika dihapus)
                'message' => $newQty > 0 ? 'Kuantitas berhasil diperbarui.' : 'Item berhasil dihapus dari keranjang.',
                'cart_count' => count($cart), // Jumlah item unik di keranjang
                'cartEmpty' => empty($cart) // boolean, true jika keranjang kosong
            ]);

        } catch (\Exception $e) {
            Log::error("Error updating cart via AJAX: " . $e->getMessage() . " - Payload: " . json_encode($request->all()));
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui keranjang.' // Production message
                // 'message' => 'Error: ' . $e->getMessage() // Development message
            ], 500);
        }
    }

    /**
     * Menghapus item dari keranjang via AJAX.
     * Dipanggil dari halaman keranjang/checkout.
     * Route: POST /cart/remove (dilindungi middleware 'auth')
     */
    public function ajaxRemove(Request $request)
    {
        // Validasi input
         $validated = $request->validate([
            'id' => 'required', // ID Item di keranjang (menu_id)
        ]);
        $id = $validated['id']; // menu_id

        try {
            $cart = session()->get('cart', []);

            if (!isset($cart[$id])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Produk tidak ditemukan di keranjang.'
                ], 404);
            }

            unset($cart[$id]);
            session()->put('cart', $cart);

            return response()->json([
                'success' => true,
                'message' => 'Item berhasil dihapus dari keranjang.',
                'cart_count' => count($cart),
                'cartEmpty' => empty($cart)
            ]);

        } catch (\Exception $e) {
            Log::error("Error removing item from cart via AJAX: " . $e->getMessage() . " - Payload: " . json_encode($request->all()));
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus item.' // Production message
                // 'message' => 'Error: ' . $e->getMessage() // Development message
            ], 500);
        }
    }
}