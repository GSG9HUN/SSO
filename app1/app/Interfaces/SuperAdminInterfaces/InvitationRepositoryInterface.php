<?php

namespace App\Interfaces\SuperAdminInterfaces;

use App\Interfaces\BaseInterface;

interface InvitationRepositoryInterface extends BaseInterface
{
    public function findByEmail(string $email);
    public function findByID(int $id);


}
