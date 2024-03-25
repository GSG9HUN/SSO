<?php

namespace App\Http\Controllers\SuperAdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdminRequests\SpeciesRequest;
use App\Interfaces\SuperAdminInterfaces\SpeciesRepositoryInterface;
use Illuminate\Http\JsonResponse;

class SpeciesController extends Controller
{
    private SpeciesRepositoryInterface $speciesRepositoryInterface;

    public function __construct(SpeciesRepositoryInterface $speciesRepositoryInterface)
    {
        $this->speciesRepositoryInterface = $speciesRepositoryInterface;
    }

    public function index(): JsonResponse
    {

        $result = $this->speciesRepositoryInterface->getAll();

        return response()->json(['species' => $result]);
    }

    public function store(SpeciesRequest $request): JsonResponse
    {
        $saved = $this->speciesRepositoryInterface->create($request->all());

        if (!$saved) {
            return response()->json(["Something went wrong!"], 504);
        }


        return response()->json(['Success']);
    }

    public function update(SpeciesRequest $request, $id): JsonResponse
    {
        $updated = $this->speciesRepositoryInterface->update($request->all(), $id);

        if (!$updated) {
            return response()->json(["Something went wrong!"], 504);
        }


        return response()->json(['Success']);
    }

    public function destroy($id): JsonResponse
    {
        $deleted = $this->speciesRepositoryInterface->create($id);

        if (!$deleted) {
            return response()->json(["Something went wrong!"], 504);
        }
        return response()->json(['Success']);
    }
}
