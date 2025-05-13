<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\KritikSaran;
use App\Models\PromoEvent;
use App\Models\Table;
use App\Models\User;
use App\Models\Order; // <-- 1. TAMBAHKAN USE MODEL ORDER

class DashboardController extends Controller
{
    public function index()
    {
        $totalMenus      = Menu::count();
        $totalCategories = Category::count();
        $totalGallery  = Gallery::count();
        $totalKritikSaran = KritikSaran::count();
        $totalPromoEvent = PromoEvent::count();
        $totalTable = Table::count();
        $totalUsers = User::count();
        $totalOrders = Order::count(); // <-- 2. HITUNG TOTAL ORDER

        return view('admin.dashboard', compact(
            'totalMenus',
            'totalCategories',
            'totalGallery',
            'totalKritikSaran',
            'totalPromoEvent',
            'totalTable',
            'totalUsers',
            'totalOrders' // <-- 3. KIRIM KE VIEW
        ));
    }
}