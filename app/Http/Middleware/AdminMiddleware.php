<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah pengguna sudah login dan apakah rolenya adalah admin
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Jika bukan admin, tendang kembali ke dashboard user biasa dengan pesan error
        return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke halaman admin.');
    }
}