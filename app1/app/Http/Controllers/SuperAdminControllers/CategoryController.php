<?php

namespace App\Http\Controllers\SuperAdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    public function index(): JsonResponse
    {
        $result = Category::query()->paginate(10);

        return response()->json(['categories' => $result]);
    }


    /**
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $this->validate($request, [
            'categoryName' => 'required',
        ]);

        $newCategory = new Category();

        $newCategory->name = $request['categoryName'];
        $newCategory->save();

        return response()->json(['Success']);

    }


    /**
     * @throws ValidationException
     */
    public function update(Request $request, $id): JsonResponse
    {
        $this->validate($request, [
            'categoryName' => 'required',
        ]);

        Category::query()->where('id', $id)->update([
            'name' => $request['categoryName']
        ]);

        return response()->json(['Success']);
    }

    public function destroy($id): JsonResponse
    {
        Category::query()->where('id', $id)->delete();

        return response()->json(['Success']);
    }
}
