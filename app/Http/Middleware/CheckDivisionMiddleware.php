<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckDivisionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$divisions)
    {
        if (Auth::check()) {
            // Ambil divisi pengguna saat ini
            $userDivision = Auth::user()->division->name; // Adjust this according to your setup
            
            // Periksa apakah divisi pengguna termasuk dalam daftar yang diizinkan
            if (in_array($userDivision, $divisions)) {
                return $next($request);
            }
        }

        abort(403, 'Unauthorized.');
    }
}
