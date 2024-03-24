<?php

use http\Exception\InvalidArgumentException as InvalidArgumentExceptionAlias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::get('/', function () {
    return view('welcome');
});

Route::get("login", function (Request $request){
    $request->session()->put("state",$state=Str::random(40));
    $query = http_build_query([
        "client_id" =>"9b9ffe0f-6e0d-4264-96c6-5846ea9fd979",
        "redirect_uri" =>"http://127.0.0.1:8080/callback",
        "response_type"=>"code",
        "scope"=>"",
        "state"=>$state
    ]);
    return redirect("http://127.0.0.1:8000/oauth/authorize?".$query);
});

Route::get("/callback", function (Request $request){
   $state = $request->session()->pull("state");
   throw_unless(strlen($state) >0 && $state = $request->state, InvalidArgumentExceptionAlias::class);
   $response = Http::asForm()->post("http://127.0.0.1:8000/oauth/token",[
       "grant_type"=>"authorization_code",
       "client_id"=>"9b9ffe0f-6e0d-4264-96c6-5846ea9fd979",
       "client_secret" =>"R0L2TR2atAPQfZn58rxhKzeVxHNie0ourTaXlxOS",
       "redirect_uri"=>"http://127.0.0.1:8080/callback",
       "code" => $request->code
   ]);
   return $response->json();
});
