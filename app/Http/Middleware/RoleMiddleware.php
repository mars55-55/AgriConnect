<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $user = Auth::user();

        // Verifica si el usuario está autenticado y tiene el rol requerido
        if (!$user || !in_array($user->role, explode('|', $role))) {
            return response()->json(['error' => 'No tienes acceso a esta sección.'], 403);
        }

        return $next($request);
    }
}
