<?php

namespace App\Http\Controllers\admin;

use App\brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands=brand::paginate(5);
        return view('brand.index',compact('brands'));
    }

    public function loadBrand(){
        $brands=brand::all();
        return response()->json($brands);
    }

    public function selectBrand(Request $request){
        $id=$request['id'];
        $brand=brand::find($id);
        return response()->json($brand);
    }

    public function addBrand(Request $request){
        $name=$request['name'];
        $description=$request['description'];
        $img=$request['img'];

        $brand=new brand();
        $brand->name=$name;
        $brand->description=$description;
        $brand->img=$img;
        $brand->save();

        return response()->json($brand);
    }

    public function editBrand(Request $request){
        $id=$request['id'];
        $name=$request['name'];
        $description=$request['description'];
        $img=$request['img'];

        $brand=brand::find($id);
        $brand->name=$name;
        $brand->description=$description;
        $brand->img=$img;
        $brand->save();

        return response()->json($brand);
    }

    public function deleteBrand(Request $request){
        $id=$request['id'];
        $brand=brand::find($id);
        $brand->delete();

        return response()->json($brand);
    }
}
