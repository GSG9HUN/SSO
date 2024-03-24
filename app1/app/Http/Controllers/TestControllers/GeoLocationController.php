<?php

namespace App\Http\Controllers\TestControllers;

use App\Http\Controllers\Controller;
use App\Models\IPDetails;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;

class GeoLocationController extends Controller
{

    public function index(Request $request){
        $ip = $request->ip();
        $data = Location::get($ip);
        $this->store($data);
    }


    private function store($data){

        $ipDetails = new IPDetails();
        $ipDetails->country_name =$data['countryName'];
        $ipDetails->religion_name =$data['religionName'];
        $ipDetails->city_name =$data['cityName'];
        $ipDetails->ip =$data['ip'];
        $ipDetails->connected_at =Carbon::now();

        $ipDetails->save();
    }
}
