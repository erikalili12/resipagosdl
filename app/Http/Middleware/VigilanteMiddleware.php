<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VigilanteMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->hasRole('vigilante')) {
            return $next($request);
        }

        return redirect()->route('home')->with('error', 'No tienes permiso para acceder a esta página.');
    }
}
