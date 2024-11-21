<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPokja
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, $role, $pokja = null,  Closure $next): Response
    {
        $user = auth()->user();

        if ($user->role !== $role) {
            return abort(403, 'Unauthorized.');
        }

        if ($pokja && $user->division_id != $pokja) {
            return abort(403, 'Unauthorized.');
        }

        return $next($request);
    }
}
