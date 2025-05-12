<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // solo se va al next si es admin. si no redirijir al inicio
        if ($request->user() && $request->user()->role_id != 1) {
            session()->flash('error', 'No tienes permiso para acceder a esta página.');
            return redirect('/'); // Redirigir a la página de inicio
        }

        return $next($request);
    }
}
