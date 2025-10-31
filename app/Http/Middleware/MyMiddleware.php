<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   

        // Verifico que el usuari estigui autentificat i tingui un rol de admin
        if (Auth::check() && Auth::user()->rol === 'admin') {
            return $next($request);
        }

        return response()->view('errors.permisDenegat');
    }
}
