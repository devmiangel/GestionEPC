<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureRolCoordinadorAdministrador
{
    /**
     * Handle an incoming request.
     * Allow only users with role 'Coordinador' or 'Administrador'.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            abort(403, 'No autorizado.');
        }

        $user = auth()->user();
        if (!($user->tieneRol('Coordinador') || $user->tieneRol('Administrador'))) {
            abort(403, 'No tienes permisos para realizar esta acción.');
        }

        return $next($request);
    }
}
