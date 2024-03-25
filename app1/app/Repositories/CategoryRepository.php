<?php

namespace App\Repositories;

use App\Interfaces\SuperAdminInterfaces\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAll(): LengthAwarePaginator
    {
        return Category::query()->paginate(10);
    }

    public function create(array $data):bool
    {
        $newCategory = new Category();

        $newCategory->name = $data['categoryName'];
        return $newCategory->save();
    }

    public function update(array $data, int $id):bool
    {
        return Category::query()->where('id', $id)->update([
            'name' => $data['categoryName']
        ]);
    }

    public function delete(int $id):bool
    {
        return  Category::query()->where('id', $id)->delete();
    }
}
