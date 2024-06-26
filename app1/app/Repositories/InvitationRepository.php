<?php

namespace App\Repositories;

use App\Interfaces\SuperAdminInterfaces\InvitationRepositoryInterface;
use App\Models\Invitation;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class InvitationRepository implements InvitationRepositoryInterface
{

    public function getAll(): LengthAwarePaginator
    {
        return Invitation::query()->orderBy('id', 'desc')->paginate(10);
    }

    public function create(array $data): bool
    {
        $invitation = new Invitation();
        $invitation->email = $data['email'];
        $invitation->role_id = $data['role_id'];
        $invitation->generateInvitationToken();
        return $invitation->save();
    }

    public function delete(int $id)
    {
        $invitation = Invitation::query()->where("id",$id)->first();
        if($invitation->registered_at != null){
            return false;
        }
        return $invitation->delete();
    }

    public function findByEmail(string $email): Model|Builder|null
    {
        return Invitation::query()->where("email",$email)->first();
    }

    public function findById(int $id): Model|Builder|null
    {
        return Invitation::query()->where("id",$id)->first();
    }

    public function findByEmailAndToken(string $email,string $token): Model|Builder|null
    {
        return Invitation::query()
            ->where('email',$email)
            ->where('invitation_token', $token)
            ->whereNull('registered_at')
            ->first();
    }
}
