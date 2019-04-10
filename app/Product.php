<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ProductAttribute;
class Product extends Model
{
    public function category(){
        $this->belongsTo('App/Category');
    }
    public function productAttributes(){

       return $this->hasMany(ProductAttribute::class);
    }


}
