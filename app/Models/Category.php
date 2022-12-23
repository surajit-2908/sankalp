<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'id',
        'name',
        'slug',
        'parent_id',
    ];

    public function getPcat()
    {
        return $this->hasOne(Category::class,'id','parent_id');
    }

    public function getSubcat()
    {
        return $this->hasMany(Category::class,'parent_id','id');
    }
}
