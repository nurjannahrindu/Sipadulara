<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class MasyarakatMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('masyarakat')->check()) {
            return redirect()->route('masyarakat.login');
        }

        return $next($request);
    }
}