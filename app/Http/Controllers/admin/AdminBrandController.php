<?php

namespace App\Http\Controllers\admin;

use App\brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class AdminBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands=brand::paginate(5);
        return view('brand.index',['brands'=>$brands,'controller_name'=>'Brand management']);
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
        $brand=new brand();
        $brand->name=$request['name'];
        $brand->description=$request['description'];
        if($request->hasFile('image')){
            $image=$request->file('image');
            $image_name=time()."_".$image->getClientOriginalName();
            $ext=$image->getClientOriginalExtension();
            $valid_extension=array("jpg","jpeg","png");
            if(in_array($ext,$valid_extension)){
                $image->move(public_path()."/images/brands",$image_name);
                $brand->img=$image_name;
            }
        }
        $brand->save();

        return response()->json($brand);
    }

    public function editBrand(Request $request){
        $brand=brand::find($request['id']);
        $brand->name=$request['name'];
        $brand->description=$request['description'];
        if($request->hasFile('image')){
            $image=$request->file('image');
            $image_name=time()."_".$image->getClientOriginalName();
            $ext=$image->getClientOriginalExtension();
            $valid_extension=array("jpg","jpeg","png");
            if(in_array($ext,$valid_extension)){
                $image->move(public_path()."/images/brands",$image_name);
                $brand->img=$image_name;
                $oldImg=$request['oldImg'];
                $path=public_path()."/images/brands/".$oldImg;
                if(file_exists($path) && $oldImg!=""){
                    unlink($path);
                }
            }
        }
        $brand->save();

        return response()->json($brand);
    }

    public function deleteBrand(Request $request){
        $brand=brand::find($request['id']);
        $oldImg=$request['oldImg'];
        $path=public_path()."/images/brands/".$oldImg;
        if(file_exists($path) && $oldImg!=""){
            unlink($path);
        }
        $brand->delete();

        return response()->json($brand);
    }
}
