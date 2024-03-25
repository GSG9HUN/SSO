<?php

namespace App\Repositories;

use App\Interfaces\SuperAdminInterfaces\CountyRepositoryInterface;
use App\Models\County;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CountyRepository implements CountyRepositoryInterface
{

    public function getAll(): LengthAwarePaginator
    {
        return County::query()->paginate(10);
    }

    public function create(array $data): bool
    {
        $newCounty = new County();

        $newCounty->name = $data['county'];
        return $newCounty->save();

    }

    public function update(array $data, int $id): bool
    {
        return County::query()->where('id', $id)->update([
            'name' => $data['county']
        ]);
    }

    public function delete(int $id): bool
    {
        return County::query()->where('id', $id)->delete();
    }
}
