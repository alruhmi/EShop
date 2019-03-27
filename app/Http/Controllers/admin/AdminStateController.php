<?php

namespace App\Http\Controllers\admin;

use App\Country;
use App\State;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class AdminStateController extends Controller
{
    public function Index(){
        return view('states.index');
    }

    public function loadStates(){
        $states=State::all();
        return response()->json($states);
    }

    public function selectState(Request $request){
        $state=State::find($request['id']);
        return response()->json($state);
    }

    public function addState(Request $request){
        $state=new State();
        $state->name=$request['name'];
        $state->country_id=$request['country'];
        $state->save();
        return response()->json($state);
    }

    public function updateState(Request $request){
        $state=State::find($request['id']);
        $state->name=$request['name'];
        $state->country_id=$request['country'];
        $state->save();
        return response()->json($state);
    }

    public function deleteState(Request $request){
        $state=State::find($request['id']);
        $state->delete();
        return response()->json(['message'=>'State deleted successfully']);
    }
}
