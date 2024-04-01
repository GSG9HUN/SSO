<?php

namespace App\Http\Controllers;

use App\Interfaces\SessionsRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    function logout(Request $request): void
    {
        try {
            DB::beginTransaction();
            $user = $request->user();
            $user?->tokens->each(function ($token) {
                $token->revoke();
                $this->refreshTokenRepository->revokeRefreshTokensByAccessTokenId($token->id);
            });
            $this->sessionsRepository->deleteByUserIdAndId($user->id, session()->getId());
            //Log::info($request->session());
            DB::commit();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
        }
    }
}
