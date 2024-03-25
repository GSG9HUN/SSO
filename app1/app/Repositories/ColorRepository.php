<?php

namespace App\Repositories;

use App\Interfaces\SuperAdminInterfaces\ColorRepositoryInterface;
use App\Models\Color;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ColorRepository implements ColorRepositoryInterface
{

    public function getAll(): LengthAwarePaginator
    {
        return Color::query()->paginate(10);
    }

    public function create(array $data): bool
    {
        $newColor = new Color();

        $newColor->name = $data['color'];
        return $newColor->save();
    }

    public function update(array $data, int $id): bool
    {
        return Color::query()->where('id', $id)->update([
            'name' => $data['color']
        ]);
    }

    public function delete(int $id):bool
    {
        return Color::query()->where('id', $id)->delete();
    }
}
