<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VigilanteEmailMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if ($user && $user->email === 'vigilante@gmail.com') {
            return redirect()->route('vigilante.search1');
        }

        return redirect()->route('residentes.index')->with('error', 'No tienes permiso para acceder a esta página.');
        
    }
}