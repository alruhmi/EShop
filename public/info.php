<?php
// function deleteSelectedImages( $request,$images){
//    $images=$request['images'];
//
//    $file_images=json_decode($images);
//    for ($i=0; $i<count($images); $i++ ){
//        $key=array_search($images[$i],$file_images);
//        $image_path=public_path()."/images/products/".$images[$i];
//        if (file_exists($image_path)){
//            unlink($image_path);
//        }
//        unset($file_images[$key]);
//    }
//    if(!empty($file_images)){
//        $product_img=json_encode($file_images);
//
//    }else{
//        $product_img=null;
//    }
//    echo  $product_img;
//
//}
//
//$request['images']=['image1.jpg','image2.jpg'];
// $images='["1553015381_4.jpg"]';
// deleteSelectedImages($request,$images);