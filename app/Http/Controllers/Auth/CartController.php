<?php

namespace App\Http\Controllers\Auth;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class CartController extends Controller
{
    public function add(Request $request, $id)
    {
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
    }

    public function view()
    {
        $cart = session()->get('cart', []);
        return view('user.cart', compact('cart'));
    }

    public function update(Request $request, $id)
{
    $cart = session()->get('cart', []);

    if (!isset($cart[$id])) {
        return redirect()->back()->with('error', 'Menu tidak ditemukan di keranjang.');
    }

    if ($request->type == 'increase') {
        $cart[$id]['quantity']++;
    } elseif ($request->type == 'decrease') {
        if ($cart[$id]['quantity'] > 1) {
            $cart[$id]['quantity']--;
        } else {
            unset($cart[$id]);
        }
    }

    session()->put('cart', $cart);

    return redirect()->back()->with('success', 'Keranjang berhasil diperbarui.');
}


public function remove($id)
{
    $cart = session()->get('cart', []);

    if(isset($cart[$id])) {
        unset($cart[$id]);
        session()->put('cart', $cart);
    }

    return redirect()->back()->with('success', 'Menu berhasil dihapus dari keranjang.');
}


}
