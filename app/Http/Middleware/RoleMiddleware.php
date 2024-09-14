<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Memastikan pengguna terautentikasi
        if (!Auth::check()) {
            return redirect()->route('login'); // Mengarahkan ke halaman login jika tidak terautentikasi
        }

        // Memeriksa peran pengguna
        if (Auth::user()->role !== $role) {
            abort(403, 'Unauthorized action.'); // Menghentikan akses jika peran tidak sesuai
        }

        return $next($request); // Melanjutkan ke permintaan berikutnya
    }
}
