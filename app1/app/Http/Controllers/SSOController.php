<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use http\Exception\InvalidArgumentException as InvalidArgumentExceptionAlias;
use JetBrains\PhpStorm\NoReturn;
use Throwable;

class SSOController extends Controller
{
    public function login(Request $request): \Illuminate\Foundation\Application|Redirector|Application|RedirectResponse
    {
        $request->session()->put("state",$state=Str::random(40));
        $query = http_build_query([
            "client_id" =>"9b9ffe0f-6e0d-4264-96c6-5846ea9fd979",
            "redirect_uri" =>"http://127.0.0.1:8080/callback",
            "response_type"=>"code",
            "scope"=>"",
            "state"=>$state
        ]);
        return redirect("http://127.0.0.1:8000/oauth/authorize?".$query);
    }


    public function callback(Request $request)
    {
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
    }
}
