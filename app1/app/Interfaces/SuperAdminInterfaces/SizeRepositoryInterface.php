<?php

namespace App\Interfaces\SuperAdminInterfaces;

use App\Interfaces\BaseInterface;

interface SizeRepositoryInterface extends BaseInterface
{
    public function update(array $data, int $id);
}
