<?php

namespace Tests\Feature;

use App\Http\Controllers\admin\AdminProductController;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{

    public function deleteSelectedImages($request, $images_product)
    {
        $images = $request['images'];

        $file_images = json_decode($images_product);
        for ($i = 0; $i < count($images); $i++) {
            if (in_array($images[$i], $file_images)) {
                $image_path = public_path() . "/images/products/" . $images[$i];
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
                $file_images =array_values( array_diff($file_images, array($images[$i])));
            }

        }
        if (!empty($file_images)) {
            $product_img = json_encode($file_images);

        } else {
            $product_img = null;
        }

        echo $product_img;
        return $product_img;
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $productController = new ProductController();

        $request['images'] = ['image1.jpg'];
        $images = '["image1.jpg","image2.jpg"]';
        $result = $this->deleteSelectedImages($request, $images);
        $actualResult = '["image2.jpg"]';
        echo "\n\nactualResult:" . $actualResult . "\n";
        echo "result:" . $result;
        $this->assertTrue($result == $actualResult);
    }

}
