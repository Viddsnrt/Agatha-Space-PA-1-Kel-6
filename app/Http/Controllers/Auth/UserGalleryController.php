<?php 
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Gallery;

class UserGalleryController extends Controller 
{
    public function index() 
    {
        $images = Gallery::latest()->get();
        return view('user.gallery', compact('images'));
    }
}