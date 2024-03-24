<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\County;
use App\Models\Roles;
use Illuminate\Http\JsonResponse;

class SelectSearchController extends Controller
{
    function getCountyOptions(): JsonResponse
    {
        $options = County::query()
            ->select('name as label', 'id as value')
            ->orderBy('id')
            ->get();

        return response()->json(['countyOptions' => $options]);
    }


    function getAnimalCategoryOptions(): JsonResponse
    {
        $options = Category::query()
            ->select('name as label', 'id as value')
            ->orderBy('id')
            ->get();

        return response()->json(['animalCategoryOptions' => $options]);
    }

    function getUserRolesOptions(): JsonResponse
    {
        $options = Roles::query()
            ->select('name as label', 'id as value')
            ->orderBy('id')
            ->get();
        return response()->json(['userRolesOptions' => $options]);
    }
}
