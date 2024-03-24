<?php

use App\Http\Controllers\SelectSearchController;
use App\Http\Controllers\SuperAdminControllers\CountyController;
use App\Http\Controllers\SuperAdminControllers\SpeciesController;
use App\Http\Controllers\SuperAdminControllers\SettlementController;
use App\Http\Controllers\SuperAdminControllers\CategoryController;
use App\Http\Controllers\SuperAdminControllers\ColorController;
use App\Http\Controllers\SuperAdminControllers\InvitationController;
use App\Http\Controllers\SuperAdminControllers\SizeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth')->group(function(){
    Route::resource('/invitations',InvitationController::class);
    Route::resource('/counties', CountyController::class);
    Route::resource('/category', CategoryController::class);
    Route::resource('/size', SizeController::class);
    Route::resource('/species', SpeciesController::class);
    Route::resource('/colors', ColorController::class);
    Route::resource('/settlement', SettlementController::class);



    Route::get('/SelectSearch/county',[SelectSearchController::class,'getCountyOptions']);
    Route::get('/SelectSearch/category',[SelectSearchController::class,'getAnimalCategoryOptions']);
});

