<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';
    protected $fillable = [
        'id',
        'product_id',
        'image_name'
    ];

    public function getCat()
    {
        return $this->hasOne(Category::class,'id','cat_id');
    }
}
