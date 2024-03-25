<?php

namespace App\Http\Controllers\SuperAdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdminRequests\SettlementRequest;
use App\Interfaces\SuperAdminInterfaces\SettlementRepositoryInterface;
use Illuminate\Http\JsonResponse;

class SettlementController extends Controller
{
    private SettlementRepositoryInterface $settlementRepositoryInterface;
    public function __construct(SettlementRepositoryInterface $settlementRepositoryInterface)
    {
        $this->settlementRepositoryInterface = $settlementRepositoryInterface;
    }

    public function index(): JsonResponse
    {
        $result = $this->settlementRepositoryInterface->getAll();

        return response()->json(['settlement'=>$result]);
    }

    public function store(SettlementRequest $request): JsonResponse
    {

        $saved = $this->settlementRepositoryInterface->create($request->all());

        if(!$saved){
            return response()->json(["Something went wrong!"],504);
        }

        return response()->json(['Success']);
    }


    public function update(SettlementRequest $request, $id): JsonResponse
    {

        $updated = $this->settlementRepositoryInterface->update($request->all(),$id);

        if(!$updated){
            return response()->json(["Something went wrong!"],504);
        }

        return response()->json(['Success']);
    }

    public function destroy($id): JsonResponse
    {
        $deleted = $this->settlementRepositoryInterface->delete($id);

        if(!$deleted){
            return response()->json(["Something went wrong!"],504);
        }

        return response()->json(['Success']);
    }
}
