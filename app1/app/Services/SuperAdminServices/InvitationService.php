<?php

namespace App\Services\SuperAdminServices;

use App\Mail\RegistrationInvitationSend;
use App\Models\Invitation;
use App\Repositories\InvitationRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Mail;

class InvitationService
{
    private InvitationRepository $invitationRepository;

    public function __construct(InvitationRepository $invitationRepository)
    {
        $this->invitationRepository = $invitationRepository;
    }

    public function getAll(): LengthAwarePaginator
    {
        return $this->invitationRepository->getAll();
    }

    public function createNewInvitation(array $data): bool
    {
        $saved = $this->invitationRepository->create($data);
        if(!$saved){
            return false;
        }
        $invitation = $this->invitationRepository->findByEmail($data["email"]);
        $this->sendMail($invitation);

        return true;
    }

    public function delete($id): bool
    {
        $invitation = $this->invitationRepository->findById($id);
        if($invitation->registered_at){
            return false;
        }
        $invitation->delete();
        return true;
    }

    public function sendMail(Invitation $invitation): void
    {
        Mail::to($invitation->email)->send(new RegistrationInvitationSend($invitation->invitation_token));
    }

}
