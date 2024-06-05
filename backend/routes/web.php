<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Middleware\TokenValidation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\RefreshToken;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes(["register"=>false]);

Route::get("register",[RegisterController::class,"showRegistrationForm"]);
Route::post("register",[RegisterController::class,"register"])->middleware(TokenValidation::class)->name("register");

Route::get("test",function (){

    $refreshToken = RefreshToken::where('user_id', Auth::id())
        ->orderBy('created_at', 'desc')
        ->first();
    return  $refreshToken;
});
