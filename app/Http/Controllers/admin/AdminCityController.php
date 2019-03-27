<?php

namespace App\Http\Controllers\admin;

use App\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class AdminCityController extends Controller
{

    public function Index(){
        return view('cities.index');
    }

    public function loadCities(){
        $cities=City::all();
        return response()->json($cities);
    }

    public function selectCity(Request $request){
        $city=City::find($request['id']);
        return response()->json($city);
    }

    public function addCity(Request $request){
        $city=new City();
        $city->name=$request['name'];
        $city->state_id=$request['state'];
        $city->save();
        return response()->json($city);
    }

    public function updateCity(Request $request){
        $city=City::find($request['id']);
        $city->name=$request['name'];
        $city->state_id=$request['state'];
        $city->save();
        return response()->json($city);
    }

    public function deleteCity(Request $request){
        $city=City::find($request['id']);
        $city->delete();
        return response()->json(['message'=>'City deleted successfully']);
    }
}
