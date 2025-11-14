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
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Vérifie si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Si l'utilisateur n'est pas admin, on le redirige vers son profil
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('home')->with('error', 'Accès refusé. Vous n\'avez pas les droits d\'administrateur.');
        }

        return $next($request);
    }
}
