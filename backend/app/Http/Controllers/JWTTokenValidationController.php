<?php

namespace App\Http\Controllers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Laravel\Passport\TokenRepository;

class JWTTokenValidationController extends Controller
{
    protected $tokenRepository;

    public function __construct(TokenRepository $tokenRepository)
    {
        $this->tokenRepository = $tokenRepository;
    }

    public function validateToken(Request $request): JsonResponse
    {
        $token = $request->input('token');

        $publicKey = File::get(storage_path('/oauth-public.key'));

        $publicKey = new Key($publicKey, 'RS256');

        $decodedToken = JWT::decode($token, $publicKey);

        $tokenId = $decodedToken->jti;

        $token = $this->tokenRepository->find($tokenId);

        if (!$token || $token->revoked) {
            return response()->json(['error' => 'Invalid token'], 401);
        }

        return response()->json(["active"=>!$token->revoked]);
    }

    public function refreshToken(Request $request)
    {
        //TODO: generate new token, and new refresh token;
    }
}
