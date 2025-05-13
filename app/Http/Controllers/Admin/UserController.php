<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User; // Pastikan namespace model User benar
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->paginate(10); // Ambil semua user, urutkan terbaru, dan paginasi
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Nanti bisa untuk tambah user baru
        // return view('admin.users.create');
        abort(404); // Untuk sekarang, kita hanya fokus pada tampilan list
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Nanti untuk proses simpan user baru
        abort(404);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // Nanti bisa untuk lihat detail user
        // return view('admin.users.show', compact('user'));
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // Nanti untuk form edit user
        // return view('admin.users.edit', compact('user'));
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Nanti untuk proses update user
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Nanti untuk hapus user
        // $user->delete();
        // return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
        abort(404);
    }
}