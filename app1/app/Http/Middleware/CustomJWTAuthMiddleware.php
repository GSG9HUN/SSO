<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class CustomJWTAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['error' => 'Token not provided'], 401);
        }

        $response = Http::withToken($token)->post(env('SSO_HOST').'/api/validateToken', [
            'token' => $token,
        ]);

        if ($response->status() !== 200 || !$response->json()['active']) {
            return response()->json(['error' => 'Invalid token'], 401);
        }

        return $next($request);
    }
}
