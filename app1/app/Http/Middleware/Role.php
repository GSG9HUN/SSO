<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param String $role
     * @return mixed
     */

    public function handle(Request $request, Closure $next, String $role): mixed
    {
        if(Auth::user()->role_id == $role)
            return $next($request);

        return abort(401);
    }
}
