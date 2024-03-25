<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function getByEmail(string $email);
    public function create(array $data);
    public function update(array $data);

}
