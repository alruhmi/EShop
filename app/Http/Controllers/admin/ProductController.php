<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\brand;
use App\category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function PhpParser\filesInDir;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=DB::table('products')->LeftJoin('brands','products.brand_id','=','brands.id')
            ->LeftJoin('categories','products.category_id','=','categories.id')
            ->select('products.*','brands.name as brand_name','categories.name as category_name')
            ->paginate(5);
        $brands=Brand::all();
        $categories=Category::all();

        return view('products.index',['products'=>$products, 'categories'=>$categories, 'brands'=>$brands]);
    }

    public function addProduct(Request $request){
//        $this->validate($request,[
//            'name'=>'required',
//
//        ]);

        $name=$request['name'];
        $title=$request['title'];
        $price=$request['price'];
        $details=$request['details'];
        $description=$request['description'];
        $brand=$request['brand'];
        $category=$request['category'];

        $product = new Product();
        $product->name=$name;
        $product->title=$title;
        $product->price=$price;
        $product->details=$details;
        $product->description=$description;
        $product->brand_id=$brand;
        $product->category_id=$category;
        $product->save();

        $brand=Brand::find($brand);
        $category=category::find($category);
        return response()->json(['product'=>$product,'brand'=>$brand, 'category'=>$category]);

    }

    public function showProduct(Request $request){
        $id=$request['id'];
        $product=Product::find($id);
        $brand=Brand::find($product->brand_id);
        $category=category::find($product->category_id);
        return response()->json(['product'=>$product,'brand'=>$brand, 'category'=>$category]);
    }

    public function editProduct(Request $request){
        $id=$request['id'];
        $name=$request['name'];
        $title=$request['title'];
        $price=$request['price'];
        $details=$request['details'];
        $description=$request['description'];
        $brand=$request['brand'];
        $category=$request['category'];

        $product=Product::find($id);
        $product->name=$name;
        $product->title=$title;
        $product->price=$price;
        $product->details=$details;
        $product->description=$description;
        $product->brand_id=$brand;
        $product->category_id=$category;
        $product->save();

        $brand=Brand::find($brand);
        $category=category::find($category);
        return response()->json(['product'=>$product,'brand'=>$brand, 'category'=>$category]);
    }

    public function deleteProduct(Request $request)
    {
        $product=Product::find($request['id']);
        $product->delete();
        return response()->json();
    }
}

