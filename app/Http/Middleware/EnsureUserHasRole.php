<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Restrict a route to users with one of the given roles.
 *
 * Usage: ->middleware('role:admin,super-admin')
 */
class EnsureUserHasRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        $user = $request->user();

        if (!$user || !in_array($user->role, $roles, true)) {
            abort(403);
        }

        return $next($request);
    }
}
