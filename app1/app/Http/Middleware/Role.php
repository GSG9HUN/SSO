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
     * @return mixed
     */

    public function handle(Request $request, Closure $next, String $role): mixed
    {

        Log::info(Auth::user()->role_id);

        if(Auth::user()->role_id == $role)
            return $next($request);

        return abort(401);
    }
}
