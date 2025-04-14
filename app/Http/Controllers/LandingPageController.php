<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index() {
        return view('user.landing');
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


