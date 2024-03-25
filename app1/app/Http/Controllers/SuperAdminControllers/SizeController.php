<?php

namespace App\Http\Controllers\SuperAdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdminRequests\SizeRequest;
use App\Interfaces\SuperAdminInterfaces\SizeRepositoryInterface;
use Illuminate\Http\JsonResponse;

class SizeController extends Controller
{
    private SizeRepositoryInterface $sizeRepositoryInterface;

    public function __construct(SizeRepositoryInterface $sizeRepositoryInterface)
    {
        $this->sizeRepositoryInterface = $sizeRepositoryInterface;
    }

    public function index(): JsonResponse
    {
        $result = $this->sizeRepositoryInterface->getAll();

        return response()->json(['sizes' => $result]);
    }

    public function store(SizeRequest $request): JsonResponse
    {

        $saved = $this->sizeRepositoryInterface->create($request->all());

        if (!$saved) {
            return response()->json(["Something went wrong!"], 504);
        }

        return response()->json(['Success']);
    }


    public function update(SizeRequest $request, $id): JsonResponse
    {
        $updated = $this->sizeRepositoryInterface->update($request->all(), $id);

        if (!$updated) {
            return response()->json(["Something went wrong!"], 504);
        }

        return response()->json(['Success']);
    }

    public function destroy($id): JsonResponse
    {
        $deleted = $this->sizeRepositoryInterface->create($id);

        if (!$deleted) {
            return response()->json(["Something went wrong!"], 504);
        }

        return response()->json(['Success']);
    }
}
