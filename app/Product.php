<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category(){
        $this->belongsTo('App/Category');
    }
    protected $fillable=[
        'name','title','details','price','description','brand_id','category_id',
        'img'
    ];
}
