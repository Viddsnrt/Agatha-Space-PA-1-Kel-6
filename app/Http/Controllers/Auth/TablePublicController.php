<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Table;

class TablePublicController extends Controller
{
    // Menampilkan daftar semua meja ke user
    public function index()
    {
        $tables = Table::orderBy('created_at', 'desc')->get();
        return view('user.reservasi', compact('tables'));
    }
}
