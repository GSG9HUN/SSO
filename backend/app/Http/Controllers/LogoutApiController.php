<?php

namespace App\Http\Controllers;

use App\Interfaces\SessionsRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Laravel\Passport\RefreshTokenRepository;

class LogoutApiController extends Controller
{
    private RefreshTokenRepository $refreshTokenRepository;
    private SessionsRepositoryInterface $sessionsRepository;

    public function __construct(RefreshTokenRepository $refreshTokenRepository, SessionsRepositoryInterface $sessionsRepository)
    {
        $this->refreshTokenRepository = $refreshTokenRepository;
        $this->sessionsRepository = $sessionsRepository;
    }

    function logout(Request $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $user = $request->user();
            $email = Auth::guard("api")->user()->email;
            $user?->tokens->each(function ($token) {
                $token->revoke();
                $this->refreshTokenRepository->revokeRefreshTokensByAccessTokenId($token->id);
            });
            $this->sessionsRepository->deleteByUserIdAndId($user->id, session()->getId());
            DB::commit();
            return response()->json($email);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
        }
        return response()->json(null, JsonResponse::HTTP_UNAUTHORIZED);
    }
}
