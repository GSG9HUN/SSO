<?php

namespace App\Repositories;

use App\Interfaces\SuperAdminInterfaces\SpeciesRepositoryInterface;
use App\Models\Species;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SpeciesRepository implements SpeciesRepositoryInterface
{

    public function getAll(): LengthAwarePaginator
    {
        return Species::query()->with('category')->orderBy('id', 'desc')->paginate(10);
    }

    public function create(array $data): bool
    {
        $newSpecie = new Species();
        $newSpecie->name = $data['speciesName'];
        $newSpecie->category_id = $data['category_id'];
        $newSpecie->hair_type = $data['hair_type'] ?? null;

        return $newSpecie->save();
    }

    public function update(array $data, int $id): bool
    {
        return Species::query()->where('id', $id)->update([
            'name' => $data['speciesName'],
            'category_id' => $data['category_id'],
            'hair_type' => $data['hair_type'],
        ]);

    }

    public function delete(int $id): bool
    {
        return Species::query()->where('id', $id)->delete();

    }
}
