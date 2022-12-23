<?php

namespace App\Http\Composers;

use Illuminate\View\View;
use App\Models\Category;

class CategoryComposer
{
    public function compose(View $view)
    {
        $view->with('productCat', Category::where('parent_id', '0')->get());
    }
}
