<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
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
        // Si el usuario tiene el rol admin le permitiremos continuar
        if(auth()->user()->role == 'admin')
            // Con el return significa que el middleware esta permitiendo a la solicitud del usuario continuar, o sea, el usuario tiene permitido continuar y la ruta sera resuelta
            return $next($request);

        // Pero si no vamos a redirigir al usuario a la ruta de inicio. También se podría crear una ruta especifica que diga que no tiene permiso para acceder y a esa página se redireccionaria
        return redirect('/');

    }
}
