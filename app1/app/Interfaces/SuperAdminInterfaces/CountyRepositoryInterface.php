<?php

namespace App\Interfaces\SuperAdminInterfaces;

use App\Interfaces\BaseInterface;

interface CountyRepositoryInterface extends BaseInterface
{
    public function update(array $data, int $id);
}
