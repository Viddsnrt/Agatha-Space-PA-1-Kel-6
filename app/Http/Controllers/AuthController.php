<?php

namespace App\Http\Controllers; // Pastikan namespace ini benar

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Menu; // <-- TAMBAHKAN: Import model Menu
use Illuminate\Support\Facades\Log; // <-- TAMBAHKAN: Untuk logging
use Illuminate\Validation\Rule; // <-- TAMBAHKAN: Untuk validasi exists

class AuthController extends Controller
{
    // Menampilkan form login dan meneruskan parameter
    public function showLogin(Request $request)
    {
        $redirectTo = $request->query('redirect_to');
        $addMenuAfterLogin = $request->query('add_menu_after_login');

        // Simpan URL tujuan agar redirect()->intended() bekerja dengan baik jika $redirectTo ada
        if ($redirectTo) {
            session(['url.intended' => $redirectTo]);
        }

        // Karena viewnya di admin/auth/login.blade.php
        return view('admin.auth.login', [
            'redirect_to_param' => $redirectTo,
            'add_menu_after_login_param' => $addMenuAfterLogin,
        ]);
    }

    // Memproses login, termasuk penambahan item ke keranjang
    public function authenticate(Request $request)
    {
        // Validasi input standar dan input tambahan dari hidden fields
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
            'redirect_to_after_login' => ['nullable', 'string', 'max:1991'], // URL
            'menu_id_to_add_after_login' => [
                'nullable',
                'integer',
                Rule::exists('menus', 'id') // Pastikan menu_id valid dan ada di tabel menus
            ]
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember'); // Cek apakah checkbox 'remember' dicentang

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $menuIdToAdd = $request->input('menu_id_to_add_after_login');
            $customRedirectTo = $request->input('redirect_to_after_login');

            // --- AWAL: Logika Tambah Item ke Keranjang Setelah Login ---
            if ($menuIdToAdd) {
                $menu = Menu::find($menuIdToAdd);
                if ($menu) {
                    try {
                        $cart = session()->get('cart', []);
                        if (isset($cart[$menuIdToAdd])) {
                            // Item sudah ada, kirim notifikasi info
                            session()->flash('status_after_login_add_item_type', 'info');
                            session()->flash('status_after_login_add_item', $menu->nama . ' sudah ada di keranjang.');
                        } else {
                            // Tambahkan item baru ke keranjang
                            $cart[$menuIdToAdd] = [
                                "nama" => $menu->nama,
                                "gambar" => $menu->gambar, // Pastikan field ini ada di model Menu Anda
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
                        session()->flash('status_after_login_add_item', 'Terjadi kesalahan saat menambahkan item.');
                    }
                } else {
                    // Menu tidak ditemukan
                    session()->flash('status_after_login_add_item_type', 'error');
                    session()->flash('status_after_login_add_item', 'Menu yang ingin ditambahkan tidak ditemukan.');
                }
            }
            // --- AKHIR: Logika Tambah Item ke Keranjang Setelah Login ---

            // Logika Redirect:
            // 1. Jika ada $customRedirectTo (dari halaman menu), redirect ke sana.
            if ($customRedirectTo) {
                return redirect()->to($customRedirectTo);
            }

            // 2. Jika tidak ada $customRedirectTo, gunakan logika redirect yang sudah ada.
            //    Cek apakah user adalah admin
            if (Auth::user()->is_admin) { // Pastikan model User Anda memiliki atribut/accessor 'is_admin'
                return redirect()->route('admin.dashboard');
            } else {
                // Jika user biasa, redirect ke 'home' atau intended URL jika ada dari sebelumnya
                return redirect()->intended(route('home'));
            }
        }

        // Jika login gagal
        return back()->with('error', 'Email atau kata sandi salah. Silakan coba lagi.')
                     ->withInput($request->except('password')); // Kembalikan input email, jangan password
    }

    public function showRegister()
    {
        // Jika form register juga di admin/auth/register.blade.php
        return view('user.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:5|confirmed', // 'min:5' contoh, sesuaikan kebutuhan
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            // Jika ada field 'is_admin', set defaultnya di sini jika perlu, misal 'is_admin' => 0
        ]);

        return redirect()->route('login')->with('success', 'Berhasil daftar! Silakan login.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login'); // Atau ke halaman landing jika ada
    }
}