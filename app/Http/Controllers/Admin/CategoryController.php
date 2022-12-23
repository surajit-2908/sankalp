<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends BaseController
{

    /**
     * category listing
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $categoryArr = Category::where('parent_id', '0')->orderBy('name')->get();

        $dataArr = [
            "page_title" => "Category",
            "categoryArr" => $categoryArr
        ];

        return view('pages.admin.category.index')->with('dataArr', $dataArr);
    }

    /**
     * category add page
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function categoryAdd()
    {
        $parentCategoryArr = Category::where('parent_id', '0')->OrderBy('name')->get();
        $dataArr = [
            "page_title" => "Add Category",
            "parentCategoryArr" => $parentCategoryArr
        ];

        return view('pages.admin.category.add_category')->with('dataArr', $dataArr);
    }

    /**
     * category store
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function categoryInsert(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $slug = str_slug($request->name);
        Category::create([
            'name' => $request->name,
            'slug' => $slug
        ]);

        return redirect()->route('admin.category')->with([
            "message" => [
                "result" => "success",
                "msg" => "Category added successfully."
            ]
        ]);
    }

    /**
     * category edit page
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function categoryEdit($id)
    {
        $categoryArr = Category::find($id);
        $parentCategoryArr = Category::where('parent_id', '0')->OrderBy('name')->get();
        $dataArr = [
            "page_title" => "Edit Category",
            "categoryArr" => $categoryArr,
            "parentCategoryArr" => $parentCategoryArr,
        ];

        return view('pages.admin.category.edit_category')->with('dataArr', $dataArr);
    }

    /**
     * category update
     * @param int $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function categoryUpdate(Request $request, $id)
    {
        $categoryArr = Category::find($id);

        $request->validate([
            'name' => 'required'
        ]);


        $slug = str_slug($request->name);
        $updateArray['name'] = $request->name;
        $updateArray['slug'] = $slug;
        $categoryArr->update($updateArray);

        return redirect()->route('admin.category')->with([
            "message" => [
                "result" => "success",
                "msg" => "Category updated successfully."
            ]
        ]);
    }

    /**
     * category remove
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function categoryRemove($id)
    {
        Category::where('parent_id', $id)->delete();
        Category::find($id)->delete();

        return redirect()->route('admin.category')->with([
            "message" => [
                "result" => "success",
                "msg" => "Category deleted successfully."
            ]
        ]);
    }
}
