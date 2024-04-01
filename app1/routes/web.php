<?php

use App\Http\Controllers\SSOController;

use App\Http\Controllers\TestControllers\GeoLocationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('welcome');
});

Route::get("/sso/login", [SSOController::class,"login"])->name("sso.login");

Route::get("/callback", [SSOController::class,"callback"])->name("sso.callback");

Route::get("/sso/user",[SSOController::class,"connectUser"])->name("sso.user");

Auth::routes(["register"=>false,"reset"=>false,]);

Route::get('/', function () {
    return view('view_blades.welcome');
})->name('guest.welcome');


Route::get('/about_us', function () {
    return view('view_blades.about_us');
})->name('guest.about');


Route::get('/animals', function () {
    return view('view_blades.animals');
})->name('guest.animals');

Route::get('/shelters', function () {
    return view('view_blades.shelters');
})->name('guest.shelters');

Route::prefix('/super_admin_dashboard')
    ->middleware(['auth', 'verified','role:3'])
    ->group(function () {

        Route::get('/', function (){
            return view('super_admin_views.invitations');
        })->name('super_admin_dashboard');

        Route::get('/invitation', function () {
            return view('super_admin_views.invitations');
        })->name('invitations');

        Route::get('/shelters', function () {
            return view('super_admin_views.shelters');
        })->name('shelters');

        Route::get('/animals', function () {
            return view('super_admin_views.animals');
        })->name('animals');

        Route::prefix('/general')->group(function () {

            Route::get('/categories', function () {
                return view('super_admin_views.general.categories');
            })->name('general.categories');

            Route::get('/county', function () {
                return view('super_admin_views.general.counties');
            })->name('general.counties');

            Route::get('/settlement', function () {
                return view('super_admin_views.general.settlement');
            })->name('general.settlement');

            Route::get('/size', function () {
                return view('super_admin_views.general.size');
            })->name('general.size');

            Route::get('/species', function () {
                return view('super_admin_views.general.species');
            })->name('general.species');

            Route::get('/colors', function () {
                return view('super_admin_views.general.colors');
            })->name('general.colors');
        });
    });

Route::prefix('/admin_dashboard')->middleware(['auth','verified','role:2'])->group(function (){
    Route::get('/', function (){
        return view('admin_views.welcome');
    })->name('statistics');
});


Route::get('/ip',[GeoLocationController::class,'index']);
