<?php

namespace App\Http\Controllers\SuperAdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdminRequests\CategoryRequest;
use App\Interfaces\SuperAdminInterfaces\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    private CategoryRepositoryInterface $categoryRepositoryInterface;

    public function __construct(CategoryRepositoryInterface $categoryRepositoryInterface)
    {
        $this->categoryRepositoryInterface = $categoryRepositoryInterface;
    }
    public function index(): JsonResponse
    {
        $result = $this->categoryRepositoryInterface->getAll();

        return response()->json(['categories' => $result]);
    }


    public function store(CategoryRequest $request): JsonResponse
    {
        $saved = $this->categoryRepositoryInterface->create($request->all());
        if(!$saved){
            return response()->json(["Something went wrong!"],504);
        }
        return response()->json(['Success']);

    }

    public function update(CategoryRequest $request, $id): JsonResponse
    {

        $updated = $this->categoryRepositoryInterface->update($request->all(),$id);

        if(!$updated){
            return response()->json(["Something went wrong!"],504);
        }
        return response()->json(['Success']);
    }

    public function destroy($id): JsonResponse
    {
        $deleted = $this->categoryRepositoryInterface->delete($id);
        if(!$deleted){
            return response()->json(["Something went wrong!"],504);
        }
        return response()->json(['Success']);
    }
}
