<?php

// app/Http/Controllers/Admin/GalleryController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $items = Gallery::latest()->paginate(10);
        return view('admin.gallery.index', compact('items'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
        ]);

        $file = $request->file('image');
        $name = time().'.'.$file->extension();
        $file->move(public_path('uploads/gallery'), $name);

        Gallery::create(['image' => $name]);

        return redirect()->route('admin.gallery.index')
                         ->with('success','Gambar berhasil di-upload');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'image' => 'nullable|image',
        ]);

        if ($request->hasFile('image')) {
            // hapus file lama
            @unlink(public_path('uploads/gallery/'.$gallery->image));
            $file = $request->file('image');
            $name = time().'.'.$file->extension();
            $file->move(public_path('uploads/gallery'), $name);
            $gallery->image = $name;
        }
        $gallery->save();

        return redirect()->route('admin.gallery.index')
                         ->with('success','Gambar berhasil diperbarui');
    }

    public function destroy(Gallery $gallery)
    {
        @unlink(public_path('uploads/gallery/'.$gallery->image));
        $gallery->delete();

        return back()->with('success','Gambar berhasil dihapus');
    }
}
