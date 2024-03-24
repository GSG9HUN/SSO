<?php

namespace App\Http\Controllers\SuperAdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ColorController extends Controller
{
    public function index(): JsonResponse
    {
        $result = Color::query()->paginate(10);

        return response()->json(['colors' => $result]);
    }


    /**
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $this->validate($request, [
            'color' => 'required'
        ]);

        $newColor = new Color();

        $newColor->name = $request['color'];
        $newColor->save();

        return response()->json(['Success']);
    }


    /**
     * @throws ValidationException
     */
    public function update(Request $request, $id): JsonResponse
    {
        $this->validate($request, [
            'color' => 'required'
        ]);

        Color::query()->where('id', $id)->update([
            'name' => $request['color']
        ]);

        return response()->json(['Success']);
    }

    public function destroy($id): JsonResponse
    {
        Color::query()->where('id', $id)->delete();

        return response()->json(['Success']);
    }
}
