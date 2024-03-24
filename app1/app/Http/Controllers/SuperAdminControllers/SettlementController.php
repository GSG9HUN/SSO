<?php

namespace App\Http\Controllers\SuperAdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Settlement;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SettlementController extends Controller
{
    public function index(): JsonResponse
    {
        $result = Settlement::query()->with('county')->paginate(10);

        return response()->json(['settlement'=>$result]);
    }

    public function create()
    {

    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $this->validate($request,[
            'countyId'=>'required',
            'settlementName'=>'required'
        ]);

        $newSettlement = new Settlement();

        $newSettlement->name = $request['settlementName'];
        $newSettlement->county_id = $request['countyId'];

        $newSettlement->save();

        return response()->json(['Success']);
    }


    /**
     * @throws ValidationException
     */
    public function update(Request $request, $id): JsonResponse
    {

        $this->validate($request,[
            'countyId'=>'required',
            'settlementName'=>'required'
        ]);

        Settlement::query()->where('id',$id)->update([
            'name'=>$request['settlementName'],
            'county_id'=>$request['countyId'],
        ]);

        return response()->json(['Success']);
    }

    public function destroy($id)
    {
        Settlement::query()->where('id',$id)->delete();
    }
}
