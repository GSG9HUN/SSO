<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::middleware('auth:api')->get("/logout",function (Request $request){
    $user = $request->user();
    $accessToken = $user->token();
    DB::table("oauth_refresh_tokens")->where("access_token_id",$accessToken->id)->delete();
    $accessToken->delete();
    return response()->json(["message"=>"Revoked"]);
});
