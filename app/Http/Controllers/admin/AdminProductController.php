<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\brand;
use App\category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;
use function PhpParser\filesInDir;
use PhpParser\Node\Expr\Array_;

class AdminProductController extends Controller
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
        $image_file=$product->img;
//        $images=array();
        if($image_file!=null && $image_file!=""){
            $images=json_decode($image_file);

        }else{
            $images="";
        }

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

    //add new pictures to product images
    public function addNewImg(Request $request){
        $product=Product::find($request['id']);
        $images_name=array();
        if ($product->img!=null && $product->img!=""){
            $images_name=json_decode($product->img);
        }
        $pictures = $request->file('pictures');
        if ($pictures != null) {
            foreach ($pictures as $image) {
                $name_image = time() . "_" . $image->getClientOriginalName();
                $ext = $image->getClientOriginalExtension();
                $valid_extensions = array("jpeg", "jpg", "png");
                if (in_array($ext, $valid_extensions)) {
                    $image->move(public_path() . "/images/products", $name_image);
                    $images_name[]=$name_image;
                }
            }
//            $compact=array_merge($images_name,$newNames);
            $product->img = json_encode($images_name);
            $product->save();
        }
        return response()->json(json_decode($product->img));
    }

    public function deleteSelectedImages(Request $request){
        $images=$request['images'];
        $product=Product::find($request['id']);
        $file_images=json_decode($product->img);
        for ($i = 0; $i < count($images); $i++) {
            if (in_array($images[$i], $file_images)) {
                $image_path = public_path() . "/images/products/" . $images[$i];
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
                $file_images =array_values( array_diff($file_images, array($images[$i])));
            }

        }
        if(!empty($file_images)){
            $product->img=json_encode($file_images);

        }else{
            $product->img=null;
        }
        $product->save();
//
//        foreach ($images as $image ){
//            $key=array_search($image,$file_images);
//            unset($file_images[$key]);
//        }

        return response()->json(json_decode($product->img));
    }
}

