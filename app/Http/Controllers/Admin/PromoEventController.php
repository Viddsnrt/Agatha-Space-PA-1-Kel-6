<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PromoEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PromoEventController extends Controller
{
    public function index()
    {
        $events = PromoEvent::latest()->get();
        return view('admin.promo-event.index', compact('events'));
    }

    public function create()
    {
        return view('admin.promo-event.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required',
            'gambar' => 'required|image',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $path = $request->file('gambar')->store('promo-event', 'public');

        PromoEvent::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'gambar' => $path,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
        ]);

        return redirect()->route('admin.promo-event.index')->with('success', 'Promo/Event berhasil ditambahkan.');
    }

    public function edit(PromoEvent $promoEvent)
    {
        return view('admin.promo-event.edit', compact('promoEvent'));
    }

    public function update(Request $request, PromoEvent $promoEvent)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        if ($request->hasFile('gambar')) {
            Storage::disk('public')->delete($promoEvent->gambar);
            $path = $request->file('gambar')->store('promo-event', 'public');
            $promoEvent->gambar = $path;
        }

        $promoEvent->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'gambar' => $promoEvent->gambar,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
        ]);

        return redirect()->route('admin.promo-event.index')->with('success', 'Promo/Event berhasil diupdate.');
    }

    public function destroy(PromoEvent $promoEvent)
    {
        Storage::disk('public')->delete($promoEvent->gambar);
        $promoEvent->delete();
        return redirect()->route('admin.promo-event.index')->with('success', 'Promo/Event dihapus.');
    }
}
