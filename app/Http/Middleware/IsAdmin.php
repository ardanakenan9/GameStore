<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Periksa apakah pengguna yang login adalah admin
        if (!auth()->check() || !auth()->user()->is_admin) {
            return redirect()->route('login'); // Kembalikan ke halaman login jika bukan admin
        }

        return $next($request); // Lanjutkan jika admin
    }
}
