<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     protected $fillable = [
        'name', 'category_id', 'color', 'size', 'unit_price', 'quantity'
    ];


    public function category (){
        return $this->belongsTo('App\Category');
    }
}
