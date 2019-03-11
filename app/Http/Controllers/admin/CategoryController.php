<?php

namespace App\Http\Controllers\admin;


use App\category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
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
        $name=$request['name'];
        $description=$request['description'];
        $img=$request['img'];

        $category=new category();
        $category->name=$name;
        $category->description=$description;
        $category->img=$img;
        $category->save();

        return response()->json($category);
    }

    public function editCategory(Request $request){
        $id=$request['id'];
        $name=$request['name'];
        $description=$request['description'];
        $img=$request['img'];

        $category=category::find($id);
        $category->name=$name;
        $category->description=$description;
        $category->img=$img;
        $category->save();

        return response()->json($category);
    }

    public function deleteCategory(Request $request){
        $id=$request['id'];
        $category=category::find($id);
        $category->delete();

        return response()->json($category);
    }
}
