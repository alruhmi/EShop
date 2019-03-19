<?php

namespace App\Http\Controllers\admin;
use App\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class AdminCountryController extends Controller
{

    public function index()
    {
        return view('countries.index');
    }

    public function loadCountries(){
        $countries=country::all();
        return response()->json($countries);
    }

    public function selectCountry(Request $request){
        $id=$request['id'];
        $country=Country::find($id);
        return response()->json($country);
    }

    public function addCountry(Request $request){
        $name=$request['name'];
        $code=$request['code'];

        $country=new Country();
        $country->name=$name;
        $country->country_code=$code;
        $country->save();

        return response()->json($country);
    }

    public function editCountry(Request $request){
        $id=$request['id'];
        $name=$request['name'];
        $code=$request['code'];

        $country=Country::find($id);
        $country->name=$name;
        $country->country_code=$code;
        $country->save();

        return response()->json($country);
    }

    public function deleteCountry(Request $request){
        $id=$request['id'];
        $country=Country::find($id);
        $country->delete();

        return response()->json($country);
    }


}
