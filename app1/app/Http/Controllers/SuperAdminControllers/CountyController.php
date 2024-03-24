<?php

namespace App\Http\Controllers\SuperAdminControllers;

use App\Http\Controllers\Controller;
use App\Models\County;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CountyController extends Controller
{

    public function index(): JsonResponse
    {
        $result= County::query()->paginate(10);

        return response()->json(['counties'=>$result]);
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
            'county'=>'required'
        ]);

        $newCounty = new County();

        $newCounty->name = $request['county'];
        $newCounty->save();

        return response()->json(['Success']);
    }

    /**
     * @throws ValidationException
     */
    public function update(Request $request, int $id): JsonResponse
    {

        $this->validate($request,[
            'county'=>'required'
        ]);

        County::query()->where('id',$id)->update([
            'name'=>$request['county']
        ]);

        return response()->json(['Success']);
    }


    public function destroy($id): JsonResponse
    {
        County::query()->where('id',$id)->delete();

        return response()->json(['Success']);
    }
}
