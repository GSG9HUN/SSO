<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class UserRepository implements UserRepositoryInterface
{

    public function getByEmail(string $email): Model|Builder|null
    {
        return User::query()->where("email",$email)->first();
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update(array $data): int
    {
        return User::query()->where("email",$data["email"])->update($data);
    }
}
