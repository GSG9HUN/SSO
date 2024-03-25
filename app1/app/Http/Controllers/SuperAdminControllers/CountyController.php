<?php

namespace App\Http\Controllers\SuperAdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdminRequests\CountryRequest;
use App\Interfaces\SuperAdminInterfaces\CountyRepositoryInterface;
use Illuminate\Http\JsonResponse;

class CountyController extends Controller
{
    private CountyRepositoryInterface $countryRepositoryInterface;

    public function __construct(CountyRepositoryInterface $countryRepositoryInterface)
    {
        $this->countryRepositoryInterface = $countryRepositoryInterface;
    }

    public function index(): JsonResponse
    {
        $result= $this->countryRepositoryInterface->getAll();

        return response()->json(['counties'=>$result]);
    }

    public function store(CountryRequest $request): JsonResponse
    {
        $saved = $this->countryRepositoryInterface->create($request->all());

        if(!$saved){
            return response()->json(["Something went wrong!"],504);
        }

        return response()->json(['Success']);
    }

    public function update(CountryRequest $request, int $id): JsonResponse
    {
        $updated = $this->countryRepositoryInterface->update($request->all(),$id);

        if(!$updated){
            return response()->json(["Something went wrong!"],504);
        }

        return response()->json(['Success']);
    }


    public function destroy($id): JsonResponse
    {
        $deleted = $this->countryRepositoryInterface->delete($id);

        if(!$deleted){
            return response()->json(["Something went wrong!"],504);
        }

        return response()->json(['Success']);
    }
}
