<?php

namespace App\Http\Controllers\SuperAdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Species;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SpeciesController extends Controller
{
    public function index(): JsonResponse
    {

        $result = Species::query()->with('category')->orderBy('id','desc')->paginate(10);

        return response()->json(['species' => $result]);
    }


    /**
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {

        $this->validate($request, [
            'speciesName' => 'required',
            'category_id' => 'required'
        ]);

        $newSpecie = new Species();
        $newSpecie->name = $request['speciesName'];
        $newSpecie->category_id = $request['category_id'];
        $newSpecie->hair_type = $request['hair_type'] ?? null;

        $newSpecie->save();

        return response()->json(['Success']);
    }


    /**
     * @throws ValidationException
     */
    public function update(Request $request, $id): JsonResponse
    {
        $this->validate($request, [
            'speciesName' => 'required',
            'category_id' => 'required'
        ]);

        Species::query()->where('id', $id)->update([
            'name' => $request['speciesName'],
            'category_id' => $request['category_id'],
            'hair_type' => $request['hair_type'],
        ]);

        return response()->json(['Success']);
    }

    public function destroy($id): JsonResponse
    {
        Species::query()->where('id', $id)->delete();

        return response()->json(['Success']);
    }
}
