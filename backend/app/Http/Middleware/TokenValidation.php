<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class TokenValidation
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     * @throws GuzzleException
     */
    public function handle(Request $request, Closure $next): Response
    {
        $client = new Client();
            $response = $client->post($request->session()->get('clientURL') . '/api/validateToken',
                [
                    'email' => $request->session()->get('email'),
                    'token' => $request->session()->get('registrationToken')
                ]);

        Log::info($response->getBody()->getContents());
        dd("itt");
        return $next($request);
    }
}
