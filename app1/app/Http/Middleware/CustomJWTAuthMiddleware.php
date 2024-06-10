<?php

namespace App\Http\Middleware;

use App\Models\Sessions;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class CustomJWTAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
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

        if ($response->status() === 400) {
         return $response->json(["error" => "Invalid Token"], 400);
        }
        if(!$response->json()['active']){
            $responseLog = Http::withToken($token)->get(config("auth.sso_host") . "/api/logout");
            $body = $responseLog->json();
            $user = User::query()->where('email',$body)->first();
            Sessions::query()->where('user_id',$user->id)->delete();
            return response()->json(["redirect"=>env('APP_URL')."/"],302);
        }

        return $next($request);
    }
}
