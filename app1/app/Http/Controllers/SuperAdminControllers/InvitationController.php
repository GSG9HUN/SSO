<?php

namespace App\Http\Controllers\SuperAdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdminRequests\InvitationRequest;
use App\Services\SuperAdminServices\InvitationService;
use Illuminate\Http\JsonResponse;

class InvitationController extends Controller
{
    private InvitationService $invitationService;
    public function __construct(InvitationService $invitationService)
    {
        $this->invitationService = $invitationService;
    }

    function index(): JsonResponse
    {
        $result = $this->invitationService->getAll();
        return response()->json(['invitations' => $result]);
    }

    function store(InvitationRequest $request): JsonResponse
    {
        $saved = $this->invitationService->createNewInvitation($request->all());

        if ($saved) {
            return response()->json(["The invitation sent"]);
        } else {
            return response()->json(['error']);
        }


    }

    function destroy(int $id)
    {
        $deleted = $this->invitationService->delete($id);

        if(!$deleted){
            return response()->json(["Something went wrong!"]);
        }
        return response()->json(["Success"]);
    }
}
