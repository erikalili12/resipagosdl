<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if ($user && $user->email === 'admin@gmail.com') {
            return redirect()->route('residentes.index');
        }

        return redirect()->route('residentes.index')->with('error', 'No tienes permiso para acceder a esta página.');
        
        
    }
}
