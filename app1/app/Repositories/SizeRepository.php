<?php

namespace App\Repositories;

use App\Interfaces\SuperAdminInterfaces\SizeRepositoryInterface;
use App\Models\Size;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SizeRepository implements SizeRepositoryInterface
{
    public function getAll(): LengthAwarePaginator
    {
        return Size::query()->paginate(10);
    }

    public function create(array $data): bool
    {
        $newSize = new Size();

        $newSize->name = $data['size'];
        return $newSize->save();
    }

    public function update(array $data, int $id): bool
    {
        return Size::query()->where('id', $id)->update([
            'size' => $data['size']
        ]);
    }

    public function delete(int $id): bool
    {
        return Size::query()->where('id', $id)->delete();
    }
}
