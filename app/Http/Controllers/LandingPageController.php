<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index() {
        return view('landing');
    }

    public function tentangkami() {
        return view('tentangkami');
    }

    public function menu() {
        return view('menu');
    }

    public function kontak() {
        return view('kontak');
    }
}

