<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        $user = Auth::user();

        if (!$user || !$user->roles->pluck('name')->contains($role)) {
            abort(403, 'Access denied');
        }

        return $next($request);
    }
}
