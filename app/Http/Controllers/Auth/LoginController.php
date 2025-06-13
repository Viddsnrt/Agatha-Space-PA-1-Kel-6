<?php

namespace App\Http\Controllers\Auth; // Pastikan namespace ini benar

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu; // Pastikan model Menu di-import
use Illuminate\Support\Facades\Log; // Untuk logging jika terjadi error

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Menampilkan form login.
     * Menerima parameter dari query string untuk redirect dan penambahan menu.
     */
    public function showLoginForm(Request $request)
    {
        $redirectTo = $request->query('redirect_to');
        $addMenuAfterLogin = $request->query('add_menu_after_login');

        // Simpan URL tujuan agar redirect()->intended() bekerja dengan baik
        // jika redirectTo spesifik diberikan dari halaman menu.
        if ($redirectTo) {
            session(['url.intended' => $redirectTo]);
        } else {
            // Jika tidak ada redirect_to spesifik dari menu,
            // intended bisa default ke dashboard atau home.
            // Jika user langsung ke /login, intended() akan fallback ke config.
            // Jika ingin selalu ke home setelah login (jika tidak ada redirect_to dari menu):
            // session(['url.intended' => route('home')]);
        }

        // Teruskan parameter ke view agar bisa dimasukkan ke hidden input form login
        return view('auth.login', [
            'redirect_to_param' => $redirectTo,
            'add_menu_after_login_param' => $addMenuAfterLogin,
        ]);
    }

    /**
     * Memproses permintaan login.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
            // Validasi untuk hidden input dari form login
            'redirect_to_after_login' => ['nullable', 'string', 'max:1991'], // URL
            'menu_id_to_add_after_login' => ['nullable', 'integer', 'exists:menus,id'] // Pastikan ID menu valid
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $menuIdToAdd = $request->input('menu_id_to_add_after_login');
            $customRedirectTo = $request->input('redirect_to_after_login');

            // 1. Proses penambahan item ke keranjang jika ada permintaan
            if ($menuIdToAdd) {
                $menu = Menu::find($menuIdToAdd);
                if ($menu) {
                    try {
                        $cart = session()->get('cart', []);
                        if (isset($cart[$menuIdToAdd])) {
                            // $cart[$menuIdToAdd]['quantity']++; // Anda bisa memilih untuk increment atau hanya notifikasi
                            session()->flash('status_after_login_add_item_type', 'info');
                            session()->flash('status_after_login_add_item', $menu->nama . ' sudah ada di keranjang.');
                        } else {
                            $cart[$menuIdToAdd] = [
                                "nama" => $menu->nama,
                                "gambar" => $menu->gambar,
                                "harga" => $menu->harga,
                                "quantity" => 1
                            ];
                            session()->put('cart', $cart);
                            session()->flash('status_after_login_add_item_type', 'success');
                            session()->flash('status_after_login_add_item', $menu->nama . ' berhasil ditambahkan ke keranjang!');
                        }
                    } catch (\Exception $e) {
                        Log::error('Gagal menambahkan item ke keranjang (session) setelah login: ' . $e->getMessage());
                        session()->flash('status_after_login_add_item_type', 'error');
                        session()->flash('status_after_login_add_item', 'Terjadi kesalahan saat menambahkan item ke keranjang.');
                    }
                } else {
                    session()->flash('status_after_login_add_item_type', 'error');
                    session()->flash('status_after_login_add_item', 'Menu yang ingin ditambahkan tidak ditemukan.');
                }
            }

            // 2. Tentukan URL Redirect
            // Prioritaskan customRedirectTo (jika ada dari form, yang berasal dari halaman menu)
            if ($customRedirectTo) {
                return redirect()->to($customRedirectTo);
            }

            // Jika tidak ada customRedirectTo, gunakan redirect()->intended()
            // yang akan mengacu pada session('url.intended') yang diset di showLoginForm
            // atau fallback ke route('home') atau konfigurasi default.
            return redirect()->intended(route('home')); // Ganti 'home' dengan rute default setelah login Anda

        }

        // Jika login gagal
        return back()
            ->withErrors(['email' => 'Email atau kata sandi salah.']) // Kirim error spesifik ke field email
            ->withInput($request->except('password')); // Kirim ulang input kecuali password
    }

    /**
     * Proses logout pengguna.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('landing'); // Arahkan ke halaman landing atau home
    }
}