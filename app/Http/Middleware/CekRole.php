<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CekRole
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Cek apakah user sudah login dan role-nya SESUAI dengan yang diminta di route
        if (Auth::check() && Auth::user()->role == $role) {
            return $next($request);
        }

        // Jika tidak sesuai, tendang kembali ke "habitat" masing-masing
        if (Auth::check() && Auth::user()->role == 'admin') {
            return redirect('/admin/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman Tamu.');
        }

        return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman Admin.');
    }
}