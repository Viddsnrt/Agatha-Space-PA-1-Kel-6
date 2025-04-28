<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;


class LandingPageController extends Controller
{
    public function index()
{
    $bestSellers = Menu::inRandomOrder()->limit(4)->get();
    return view('user.landing', compact('bestSellers'));
}

    public function tentangkami() {
        return view('user.tentangkami');
    }

    public function menu() {
        return view('user.menu');
    }

    public function kontak() {
        return view('user.kontak');
    }
}


