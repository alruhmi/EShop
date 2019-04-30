<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\Attribute;

class ProductAttribute extends Model
{
    protected $primaryKey = "id";
    public  function product(){
         return $this->belongsTo(Product::class);
    }
    public  function attribute(){
         return $this->belongsTo(Attribute::class);
    }
}
