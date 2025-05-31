<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
{
    $user = $request->user();

    // If user is not authenticated, redirect or abort
    if (!$user) {
        abort(403, 'Unauthorized');
    }

    // If user role is in the roles array, allow
    if (in_array($user->role, $roles)) {
        return $next($request);
    }

    // Otherwise, forbidden
    abort(403, 'Unauthorized');
}
}
