<?php

namespace App\Http\Controllers\admin;

use App\Attribute;
use App\ProductAttribute;
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
    public function index(Request $request)
    {
        $objectQuery=DB::table('products')->LeftJoin('brands','products.brand_id','=','brands.id')
            ->LeftJoin('categories','products.category_id','=','categories.id')
            ->select('products.*','brands.name as brand_name','categories.name as category_name');
        $querySearch=$request['q'];
        if (isset($querySearch)){
            $objectQuery->where('products.name','LIKE',"%{$querySearch}%");
        }
        $products=$objectQuery->paginate(5);
        $brands=Brand::all();
        $categories=Category::all();

        return view('products.index',['products'=>$products, 'categories'=>$categories,
            'brands'=>$brands,'controller_name'=>'Product Management']);
    }

    public function create()
    {
        $categories=category::all();
        $brands=brand::all();
        $attributes=Attribute::all();
        return view('products.create',['categories'=>$categories,'brands'=>$brands,'attributes'=>$attributes]);
    }


    public function edit($id)
    {
        $product=Product::find($id);
        $brands=brand::all();
        $brand=brand::find($product->brand_id);
        $categories=category::all();
        $category=category::find($product->category_id);
        $allAttributes=Attribute::all();
        $attributes=array();
        $attrs=array();
        $allAttributes_values=array();
        foreach ($allAttributes as $value){
            $allAttributes_values[$value->id]=Attribute::find($value->id);
        }
        foreach ($product->productAttributes as $productAttribute){
            if (!isset($attributes[$productAttribute->attribute->id])){
                $attributes[$productAttribute->attribute->id]=array();
            }
            $attributes[$productAttribute->attribute->id][$productAttribute->id]=$productAttribute->value;
//            $attrs[$productAttribute->attribute->id]=$productAttribute->attribute->name;
            $attrs[$productAttribute->attribute->id]=Attribute::find($productAttribute->attribute->id);

        }
        return view('products.edit', [
                'product' => $product,
                'brands' => $brands,
                'categories' => $categories,
                'selected_brand' => $brand,
                'selected_category' => $category,
                'attributes' => $attributes,
                'attrs' => $attrs,
                'allAttributes' => $allAttributes,
            'allAttributes_values'=>$allAttributes_values]);
    }

    public function update(Request $request,$id)
    {
        $product=Product::find($id);
        $product->name=$request['name'];
        $product->title=title_case($request['title']);
        $product->slug=str_slug($request['slug'],'-');
        $product->price=$request['price'];
        $product->details=$request['details'];
        $product->description=$request['description'];
        $product->brand_id=$request['brand'];
        $product->category_id=$request['category'];
        $product->save();
        $existed_ids=array();
        foreach ($request['attributes'] as $key=>$values ){
            $attribute_id=$key;
            foreach ($values as $value){
                $attribute=DB::table('product_attributes')->where('product_id',$id)->where('attribute_id',$attribute_id)
                    ->where('value',$value)->first();
                if ($attribute==null){
                    $attribute=new ProductAttribute();
                    $attribute->attribute_id=$attribute_id;
                    $attribute->value=$value;
                    $attribute->product_id=$id;
                    $attribute->save();
                }
                $existed_ids[]=$attribute->id;

            }
        }
        if (!empty($existed_ids)){
            $attributes=DB::table('product_attributes')->where('product_id',$id)->whereNotIn('id',$existed_ids);
            $attributes->delete();
        }

        return redirect()->intended('admin/product');
    }

    public function addProduct(Request $request)
    {
        $product = new  Product();
        $product->name = $request['name'];
        $product->title = title_case($request['title']);
        $product->slug = str_slug($request['slug'],'-');
        $product->price = $request['price'];
        $product->details = $request['details'];
        $product->brand_id = $request['brand'];
        $product->category_id = $request['category'];
        $product->description = $request['description'];

        $images = $request->file('images');
        if ($images != null) {
            foreach ($images as $image){
                $name_image = time() . "_" ;
                if(isset($request['attributes']) && !empty($request['attributes'])){
                    foreach ($request['attributes'] as $values){
                        foreach ($values as $value){
                            $name_image .= $value."_";
                        }
                    }
                    $name_image .= $image->getClientOriginalName();
                }else{
                    $name_image .= $image->getClientOriginalName();
                }
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

        $product->save();

        foreach ($request['attributes'] as $key=>$values ){
            $attribute_id=$key;
            foreach ($values as $value){
                $a=new ProductAttribute();
                $a->attribute_id=$attribute_id;
                $a->value=$value;
                $product->productAttributes()->save($a);
                $a->product()->associate($product)->save();
            }
        }

        return redirect()->route('product.index');
    }


    public function showProduct(Request $request){
        $id=$request['id'];
        $product=Product::find($id);
        $brand=Brand::find($product->brand_id);
        $category=category::find($product->category_id);
        return response()->json(['product'=>$product,'brand'=>$brand, 'category'=>$category]);
    }

    public function editProduct(Request $request){
        $product=Product::find($request['id']);
        $product->name=$request['name'];
        $product->title=$request['title'];
        $product->slug=$request['slug'];
        $product->price=$request['price'];
        $product->details=$request['details'];
        $product->description=$request['description'];
        $product->brand_id=$request['brand'];
        $product->category_id=$request['category'];
        $product->save();

        $brand=Brand::find($request['brand']);
        $category=category::find($request['category']);
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
        $productAttribute=DB::table('product_attributes')->where('product_id','=',$request['id'])->delete();
        return response()->json(['message'=>'This product deleted successfully']);
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

    public function show(Request $request){
        $attributes=Attribute::find($request['id']);
        return response()->json($attributes);
    }

}

