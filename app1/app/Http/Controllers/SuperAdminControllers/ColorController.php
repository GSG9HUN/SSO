<?php

namespace App\Http\Controllers\SuperAdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdminRequests\ColorRequest;
use App\Interfaces\SuperAdminInterfaces\ColorRepositoryInterface;
use Illuminate\Http\JsonResponse;

class ColorController extends Controller
{
    private ColorRepositoryInterface $colorRepositoryInterface;

    public function __construct(ColorRepositoryInterface $colorRepositoryInterface)
    {
        $this->colorRepositoryInterface = $colorRepositoryInterface;
    }
    public function index(): JsonResponse
    {
        $result = $this->colorRepositoryInterface->getAll();

        return response()->json(['colors' => $result]);
    }

    public function store(ColorRequest $request): JsonResponse
    {
        $saved = $this->colorRepositoryInterface->create($request->all());

        if(!$saved){
            return response()->json(["Something went wrong!"],504);
        }
        return response()->json(['Success']);

    }



    public function update(ColorRequest $request, $id): JsonResponse
    {
        $updated = $this->colorRepositoryInterface->update($request->all(),$id);

        if(!$updated){
            return response()->json(["Something went wrong!"],504);
        }
        return response()->json(['Success']);
    }

    public function destroy($id): JsonResponse
    {
        $deleted = $this->colorRepositoryInterface->delete($id);

        if(!$deleted){
            return response()->json(["Something went wrong!"],504);
        }
        return response()->json(['Success']);
    }
}
