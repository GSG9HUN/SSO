<?php

namespace App\Http\Middleware;

use App\Models\Roles;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards): mixed
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $role = Auth::user()->role_id;
                return match ($role) {
                    Roles::IS_SUPER_ADMIN => redirect(RouteServiceProvider::SUPER_ADMIN_DASHBOARD),
                    Roles::IS_ADMIN => redirect(RouteServiceProvider::ADMIN_DASHBOARD),
                    default => redirect(RouteServiceProvider::HOME),
                };
            }
        }

        return $next($request);
    }
}
