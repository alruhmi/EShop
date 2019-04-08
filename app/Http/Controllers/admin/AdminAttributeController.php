<?php

namespace App\Http\Controllers\admin;

use App\Attribute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminAttributeController extends Controller
{
    public function Index(){
        $attributes=Attribute::paginate(5);
        return view('attributes.index',compact('attributes'));
    }

    public function addAttribute(Request $request){
        $attr=DB::table('attributes')->where('name',$request['name'])->first();
        if (!empty($attr)){
            return response()->json(['msg'=>'This attribute has already exist!']);
        }else{
            $attribute=new Attribute();
            $attribute->name=$request['name'];
            $attribute->value=json_encode($request['values']);
            $attribute->save();
            return response()->json($attribute);
        }

    }

    public function getAttributes(Request $request){
        $attribute=Attribute::find($request['id']);
        return response()->json($attribute);
    }

    public function editAttribute(Request $request){
        $attribute=Attribute::find($request['id']);
        if($attribute->name!=$request['name']){
            $attr=DB::table('attributes')->where('name',$request['name'])->first();
            if (!empty($attr)){
                return response()->json(['msg'=>'This attribute has already exist!']);
            }else{
                $attribute->name=$request['name'];
                $attribute->value=json_encode($request['values']);
                $attribute->save();
                return response()->json($attribute);
            }
        }else{
            $attribute->value=json_encode($request['values']);
            $attribute->save();
            return response()->json($attribute);
        }
    }
    public function deleteAttribute(Request $request){
        $attr=Attribute::find($request['id']);
        $attr->delete();
        return response()->json(['message'=>'Attribute deleted successfully']);
    }
}
