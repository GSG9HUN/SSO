<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Roles;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;


    public function redirectTo(): string
    {
        return match (Auth::user()->role_id) {
            Roles::IS_SUPER_ADMIN => '/super_admin_dashboard',
            Roles::IS_ADMIN => '/admin_dashboard',
            default => '/',
        };
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request): void
    {
        abort(404);
    }

    public function logout(Request $request): JsonResponse|RedirectResponse
    {
        Auth::user()->logoutFromSSOServer($request->session()->get("access_token"));
        Auth::logoutCurrentDevice();
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

         if($response = $this->loggedOut($request)){
             return $response;
         }
        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }
}
