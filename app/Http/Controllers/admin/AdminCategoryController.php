<?php

namespace App\Http\Controllers\admin;


use App\category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('category.index');
    }

    public function loadCategory(){
        $categories=category::all();
        return response()->json($categories);
    }

    public function selectCategory(Request $request){
        $id=$request['id'];
        $category=category::find($id);
        return response()->json($category);
    }

    public function addCategory(Request $request){

        $category=new category();
        $category->name=$request['name'];
        $category->description=$request['description'];
        $category->slug=$request['slug'];
        if($request->hasFile('image')){
            $image=$request->file('image');
                $image_name=time()."_".$image->getClientOriginalName();
                $ext=$image->getClientOriginalExtension();
                $valid_extensions = array("jpeg", "jpg", "png");
                if(in_array($ext,$valid_extensions)){
                    $image->move(public_path()."/images/categories",$image_name);
                    $category->img=$image_name;
                }
        }
        $category->save();

        return response()->json($category);
    }

    public function editCategory(Request $request){
        $category=category::find($request['id']);
        $category->name=$request['name'];
        $category->description=$request['description'];
        $category->slug=$request['slug'];
        if($request->hasFile('image')){
            $oldImg=$request['oldImg'];
            if($oldImg!=""){
                $path=public_path()."/images/categories/".$oldImg;
                if(file_exists($path)){
                    unlink($path);
                }
            }
            $image=$request->file('image');
            $image_name=time()."_".$image->getClientOriginalName();
            $ext=$image->getClientOriginalExtension();
            $valid_extensions = array("jpeg", "jpg", "png");
            if(in_array($ext,$valid_extensions)){
                $image->move(public_path()."/images/categories",$image_name);
                $category->img=$image_name;
            }
        }
        $category->save();

        return response()->json($category);
    }

    public function deleteCategory(Request $request){
        $id=$request['id'];
        $oldImg=$request['oldImg'];
        $path=public_path()."/images/categories/".$oldImg;
        if(file_exists($path) && $oldImg!=""){
            unlink($path);
        }
        $category=category::find($id);
        $category->delete();


        return response()->json($category);
    }
}
