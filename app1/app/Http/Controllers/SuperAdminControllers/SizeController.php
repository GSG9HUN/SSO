<?php

namespace App\Http\Controllers\SuperAdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SizeController extends Controller
{
    public function index(): JsonResponse
    {
        $result = Size::query()->paginate(10);

        return response()->json(['sizes'=>$result]);
    }


    /**
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $this->validate($request,[
            'size'=>'required'
        ]);

        $newSize = new Size();

        $newSize->name = $request['size'];
        $newSize->save();

        return response()->json(['Success']);
    }


    /**
     * @throws ValidationException
     */
    public function update(Request $request, $id): JsonResponse
    {
        $this->validate($request,[
            'size'=>'required'
        ]);

        Size::query()->where('id',$id)->update([
            'size'=>$request['size']
        ]);

        return response()->json(['Success']);
    }

    public function destroy($id): JsonResponse
    {
        Size::query()->where('id',$id)->delete();

        return response()->json(['Success']);
    }
}
