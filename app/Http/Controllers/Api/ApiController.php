<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Apartment;
use App\ApartmentFilter;




class ApiController extends Controller
{
    public function apartments(Request $request){

        $apartments = (new ApartmentFilter(Apartment::query(),$request))->apply()->get();

        return $apartments;
    }
}
