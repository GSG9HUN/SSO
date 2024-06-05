<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateTokenRequest;
use App\Services\SuperAdminServices\InvitationService;
use Illuminate\Http\JsonResponse;

class TokenValidationController extends Controller
{
    private InvitationService $invitationService;

    public function __construct(InvitationService $invitationService)
    {
        $this->invitationService = $invitationService;
    }

    function invitationTokenExist(ValidateTokenRequest $request): JsonResponse
    {
        $invitation = $this->invitationService->tokenExistAndValid($request->get("email"), $request->get("registrationToken"));
        return response()->json(['response' => $invitation ? "valid" : "not valid"]);
    }
}
