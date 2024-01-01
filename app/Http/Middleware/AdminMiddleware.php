<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Controlla che l'utente autenticato sia un admin
        if (auth()->check() && auth()->user()->is_admin) {
            return $next($request);
        }

        // Se l'utente non è un admin, redireziona alla pagina home
        return redirect()->route('home')->with('error', 'Non autorizzato.');
    }
}
