<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        // Periksa apakah admin login
        if (!Auth::guard('admin')->check()) {
            return redirect('/login')->withErrors(['error' => 'Unauthorized access.']);
        }

        return $next($request);
    }
}




