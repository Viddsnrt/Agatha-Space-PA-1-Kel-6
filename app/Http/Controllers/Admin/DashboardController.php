<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMenus = Menu::count();
        $totalCategories = Category::count();

        return view('admin.dashboard', compact('totalMenus', 'totalCategories'));
    }
}
