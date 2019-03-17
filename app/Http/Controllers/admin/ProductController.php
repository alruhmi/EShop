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

    public function addProduct(Request $request)
    {

        $product = new  Product();
        $product->name = $_POST['name'];
        $product->title = $_POST['title'];
        $product->price = $_POST['price'];
        $product->details = $_POST['details'];
        $product->brand_id = $_POST['brand'];
        $product->category_id = $_POST['category'];
        $product->description = $_POST['description'];

        $images = $request->file('images');
        if ($images != null) {
            foreach ($images as $image){
                $name_image = time() . "_" . $image->getClientOriginalName();
                $ext = $image->getClientOriginalExtension();
                $size = $image->getClientSize();
                $valid_extensions = array("jpeg", "jpg", "png");
                if (in_array($ext, $valid_extensions)) {
                    $image->move(public_path() . "/images/products", $name_image);
                    $images_name[]=$name_image;
                }
            }
            $product->img= json_encode($images_name);

        }

//        if (!empty($_FILES['image']['name']) && !empty($_FILES['image']['type'])) {
//            $fileName = time() . "_" . $_FILES['image']['name'];
//            $valid_extensions = array("jpeg", "jpg", "png");
//            $ext = $request->file('image')->getClientOriginalExtension();
//            if (in_array($ext, $valid_extensions)) {
//                $sourcePath = $_FILES['image']['tmp_name'];
//                $targetPath = public_path() . "/images/products/" . $fileName;
//                if (move_uploaded_file($sourcePath, $targetPath)) {
//                    $product->img = $fileName;
//                }
//            }
//        }

        $product->save();
        $brand = Brand::find($_POST['brand']);
        $category = category::find($_POST['category']);
        return response()->json(['product' => $product, 'brand' => $brand, 'category' => $category]);
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

    public function loadImages(Request $request){
        $product=Product::find($request['id']);
        $images=json_decode($product->img);

        return response()->json($images);
    }

    public function deleteProduct(Request $request)
    {
        $product=Product::find($request['id']);
        $images=json_decode($product->img);
        if ($images!=null){
            foreach ($images as $image) {
                $image = public_path() . "/images/products/" . $image;
                if (file_exists($image)) {
                    unlink($image);
                }
            }
        }
        $product->delete();
        return response()->json();
    }

}

