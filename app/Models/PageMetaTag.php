<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageMetaTag extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'page_name', 'meta_title', 'meta_keywords', 'meta_description'
    ];
}
