<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class UserRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            $user = auth()->user();

            // Cache roles
            Cache::remember("user_roles_{$user->id}", 600, function () use ($user) {
                return $user->getRoleNames()->toArray(); // Convert to array for caching
            });

            // Cache permissions
            Cache::remember("user_permissions_{$user->id}", 600, function () use ($user) {
                return $user->getAllPermissions()->pluck('name')->toArray(); // Convert to array for caching
            });
        }
        return $next($request);
    }
}
