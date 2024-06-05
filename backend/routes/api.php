<?php

use App\Http\Controllers\JWTTokenValidationController;
use App\Http\Controllers\LogoutApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


Route::get("/logout",[LogoutApiController::class,"logout"])->middleware('auth:api');

Route::post("/validateToken",[JWTTokenValidationController::class,"validateToken"]);
Route::post("/refreshToken",[JWTTokenValidationController::class,"refreshToken"]);
