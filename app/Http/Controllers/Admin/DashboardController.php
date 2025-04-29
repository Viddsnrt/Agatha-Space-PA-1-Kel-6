<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Gallery;    // ← import model Gallery
use App\Models\KritikSaran;
use App\Models\PromoEvent;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMenus      = Menu::count();
        $totalCategories = Category::count();
        $totalGallery  = Gallery::count();   
        $totalKritikSaran = KritikSaran::count(); 
        $totalPromoEvent = PromoEvent::count();

        return view('admin.dashboard', compact(
            'totalMenus',
            'totalCategories',
            'totalGallery',
            'totalKritikSaran',
            'totalPromoEvent'
        ));
    }
}
