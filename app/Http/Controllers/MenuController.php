<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $kategoriId = $request->input('kategori');

        $categories = Category::all();

        $query = Menu::query()->with('category');

        if ($search) {
            $query->where('nama', 'like', "%$search%");
        }

        if ($kategoriId) {
            $query->where('kategori_id', $kategoriId);
        }

        $menus = $query->get();

        return view('user.menu', compact('menus', 'categories', 'search', 'kategoriId'));
    }
}
