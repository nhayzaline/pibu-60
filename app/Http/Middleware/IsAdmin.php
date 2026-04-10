<?php

namespace App\Http\Middleware; // Pastikan namespace ini benar

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role == 'admin') {
            return $next($request);
        }

        return redirect('/login')->with('error', 'Anda tidak memiliki akses admin.');
    }
}
