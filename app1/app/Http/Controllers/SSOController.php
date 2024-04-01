<?php

namespace App\Http\Controllers;

use App\Interfaces\UserRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use http\Exception\InvalidArgumentException as InvalidArgumentExceptionAlias;

class SSOController extends Controller
{
    private UserRepositoryInterface $userRepositoryInterface;

    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepositoryInterface = $userRepositoryInterface;
    }
    public function login(Request $request): \Illuminate\Foundation\Application|Redirector|Application|RedirectResponse
    {
        $request->session()->put("state",$state=Str::random(40));
        $query = http_build_query([
            "client_id" =>config("auth.client_id"),
            "redirect_uri" =>config("auth.callback"),
            "response_type"=>"code",
            "scope"=>"",
            "state"=>$state
        ]);
        return redirect(config("auth.sso_host")."/oauth/authorize?".$query);
    }

    public function callback(Request $request): \Illuminate\Foundation\Application|Redirector|Application|RedirectResponse
    {
        $state = $request->session()->pull("state");
        throw_unless(strlen($state) >0 && $state === $request->state, InvalidArgumentExceptionAlias::class);
        $response = Http::asForm()->post(config("auth.sso_host")."/oauth/token",[
            "grant_type"=>"authorization_code",
            "client_id"=>config("auth.client_id"),
            "client_secret" =>config("auth.client_secret"),
            "redirect_uri"=>config("auth.callback"),
            "code" => $request->code
        ]);
        $request->session()->put($response->json());
        return redirect(route("sso.user"));
    }


    public function connectUser(Request $request): \Illuminate\Foundation\Application|Redirector|Application|RedirectResponse
    {
        $access_token = $request->session()->get("access_token");
        $response = Http::withHeaders([
            "Accept"=>"application/json",
            "Authorization"=>"Bearer ".$access_token
        ])->get(config("auth.sso_host")."/api/user");
        $userArray =  $response->json();
        try {
            $email = $userArray["email"];
        }catch (\Throwable $th){
            return redirect("login")->withError("Failed to get login information! Try again");
        }
        $user = $this->userRepositoryInterface->getByEmail($email);
        if(!$user){
            $success =$this->userRepositoryInterface->create($userArray);
            if(!$success){
                abort(404,"Something went wrong");
            }
        }
        Auth::login($user);
        return redirect(route("super_admin_dashboard"));
    }
}
