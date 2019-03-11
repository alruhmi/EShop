<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class brand extends Model
{
    public  function  product(){
        $this->hasMany('App/Prouduct');
    }
}
