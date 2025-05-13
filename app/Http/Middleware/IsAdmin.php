<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Pastikan ini di-import
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah pengguna sudah login DAN adalah admin
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }

        // Jika bukan admin, redirect ke halaman home user atau tampilkan error
        // return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        abort(403, 'AKSES DITOLAK. ANDA BUKAN ADMIN.'); // Atau bisa redirect ke halaman login user
    }
}