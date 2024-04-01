<?php

namespace App\Repositories;

use App\Interfaces\SessionsRepositoryInterface;
use App\Models\Sessions;

class SessionsRepository implements SessionsRepositoryInterface
{
    public function deleteByUserIdAndId(int $userID,string $sessionID)
    {
        return Sessions::query()->where('user_id',$userID)->delete();
    }
}
