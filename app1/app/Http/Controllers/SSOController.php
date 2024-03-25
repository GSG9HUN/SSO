<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use http\Exception\InvalidArgumentException as InvalidArgumentExceptionAlias;
use JetBrains\PhpStorm\NoReturn;
use Throwable;
use Workbench\App\Models\User;

class SSOController extends Controller
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function login(Request $request): \Illuminate\Foundation\Application|Redirector|Application|RedirectResponse
    {
        $request->session()->put("state",$state=Str::random(40));
        $query = http_build_query([
            "client_id" =>"9ba454c0-75be-4ab4-a404-85d12e71e263",
            "redirect_uri" =>"http://127.0.0.1:8001/callback",
            "response_type"=>"code",
            "scope"=>"",
            "state"=>$state
        ]);
        return redirect("http://127.0.0.1:8000/oauth/authorize?".$query);
    }

    public function callback(Request $request)
    {
        $state = $request->session()->pull("state");
        throw_unless(strlen($state) >0 && $state == $request->state, InvalidArgumentExceptionAlias::class);
        $response = Http::asForm()->post("http://127.0.0.1:8000/oauth/token",[
            "grant_type"=>"authorization_code",
            "client_id"=>"9ba454c0-75be-4ab4-a404-85d12e71e263",
            "client_secret" =>"4vnt8yJsKtCcdA01GsdiubnGRc7u1GlXoSdiwNi8",
            "redirect_uri"=>"http://127.0.0.1:8001/callback",
            "code" => $request->code
        ]);
        $request->session()->put($response->json());
        return redirect(route("sso.user"));
    }


    public function connectUser(Request $request){
        $access_token = $request->session()->get("access_token");
        $response = Http::withHeaders([
            "Accept"=>"application/json",
            "Authorization"=>"Bearer ".$access_token
        ])->get("http://127.0.0.1:8000/api/user");
        $userArray =  $response->json();
        try {
            $email = $userArray["email"];
        }catch (\Throwable $th){
            return redirect("login")->withError("Failed to get login information! Try again");
        }
        $user = $this->userRepository->getByEmail($email);
        if(!$user){
            $success =$this->userRepository->create($userArray);
            if(!$success){
                abort(404,"Something went wrong");
            }
        }
        Auth::login($user);
        return redirect(route("super_admin_dashboard"));
    }

}
