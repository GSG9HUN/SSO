<?php

use App\Http\Controllers\LogoutApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\RefreshTokenRepository;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


Route::get("/logout",[LogoutApiController::class,"logout"])->middleware('auth:api');
