<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Product extends Model
{
    protected $fillable = [
        'id',
        'title',
        'slug',
        'cat_id',
        'sub_cat_id',
        'description',
        'quantity',
        'selling_price',
        'selling_offer_price',
        'status',
    ];

    public function getCat()
    {
        return $this->hasOne(Category::class,'id','cat_id');
    }
    public function getSubCat()
    {
        return $this->hasOne(Category::class,'id','sub_cat_id');
    }
    public function getImages()
    {
        return $this->hasMany(ProductImage::class,'product_id','id');
    }
}
