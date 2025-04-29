<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PromoEvent;
use Illuminate\Http\Request;

class PromoEventController extends Controller
{
    public function index()
    {
        $promoEvents = PromoEvent::latest()->get();
        return view('user.promo-event', compact('promoEvents'));
    }

    public function show($id)
    {
        $promoEvent = PromoEvent::findOrFail($id);
        return view('user.promo-event.show', compact('promoEvent'));
    }
}

