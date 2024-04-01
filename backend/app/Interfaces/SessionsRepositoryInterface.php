<?php

namespace App\Interfaces;

interface SessionsRepositoryInterface
{
    public function deleteByUserIdAndId(int $userID,string $sessionID);
}
