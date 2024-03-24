<?php

namespace App\Http\Controllers\SuperAdminControllers;

use App\Http\Controllers\Controller;
use App\Mail\RegistrationInvitationSend;
use App\Models\Invitation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class InvitationController extends Controller
{
    function index(): JsonResponse
    {
        $result = Invitation::query()->orderBy('id','desc')->paginate(10);
        return response()->json(['invitations' => $result]);
    }

    /**
     * @throws ValidationException
     */
    function store(Request $request): JsonResponse
    {

        $this->validate($request,
            ['email' => 'required']
        );

        $invitation = new Invitation();
        $invitation->email = $request['email'];
        $invitation->generateInvitationToken();
        $saved = $invitation->save();

        Mail::to($invitation->email)->send(new RegistrationInvitationSend($invitation->invitation_token));

        if ($saved) {
            return response()->json([$invitation]);
        } else {
            return response()->json(['error']);
        }


    }

    function destroy(Request $request)
    {

    }
}
