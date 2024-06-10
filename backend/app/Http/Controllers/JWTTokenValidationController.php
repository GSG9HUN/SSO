<?php

namespace App\Http\Controllers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\TokenRepository;

class JWTTokenValidationController extends Controller
{
    protected TokenRepository $tokenRepository;
    protected ClientRepository $clientRepository;

    public function __construct(TokenRepository $tokenRepository,ClientRepository $clientRepository)
    {
        $this->tokenRepository = $tokenRepository;
        $this->clientRepository = $clientRepository;
    }

    public function validateToken(Request $request): JsonResponse
    {
        $token = $request->input('token');

        $publicKey = File::get(storage_path('/oauth-public.key'));

        $publicKey = new Key($publicKey, 'RS256');

        $decodedToken = JWT::decode($token, $publicKey);

        $tokenId = $decodedToken->jti;

        $token = $this->tokenRepository->find($tokenId);

        if (!$token) {
            return response()->json(['error' => 'Invalid token'], 400);
        }

        if($token->revoked){
            return response()->json(['error' => 'Revoked token'], 402);
        }

        return response()->json(["active"=>!$token->revoked]);
    }

    public function refreshToken(Request $request)
    {
        //TODO: generate new token, and new refresh token;
    }
}
