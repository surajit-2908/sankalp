<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Category;

class SubCategoryController extends BaseController
{

    /**
     * sub category listing
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $categoryArr = Category::where('parent_id', '!=', '0')->orderBy('created_at', 'DESC')->get();

        $dataArr = [
            "page_title" => "Sub Category",
            "categoryArr" => $categoryArr
        ];

        return view('pages.admin.sub_category.index')->with('dataArr', $dataArr);
    }

    /**
     * sub category add page
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function subCategoryAdd()
    {
        $parentCategoryArr = Category::where('parent_id', '0')->OrderBy('name')->get();
        $dataArr = [
            "page_title" => "Add Sub Category",
            "parentCategoryArr" => $parentCategoryArr
        ];

        return view('pages.admin.sub_category.add_sub_category')->with('dataArr', $dataArr);
    }

    /**
     * sub category store
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function subCategoryInsert(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'parent_id' => 'required',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->parent_id = $request->parent_id;
        $category->save();

        // update slug
        $slug = str_slug($request->name) . "-" . $category->id;
        $category->slug = $slug;
        $category->save();

        return redirect()->route('admin.sub.category')->with([
            "message" => [
                "result" => "success",
                "msg" => "Sub Category added successfully."
            ]
        ]);
    }

    /**
     * sub category edit page
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function subCategoryEdit($id)
    {
        $categoryArr = Category::find($id);
        $parentCategoryArr = Category::where('parent_id', '0')->OrderBy('name')->get();
        $dataArr = [
            "page_title" => "Edit Sub Category",
            "categoryArr" => $categoryArr,
            "parentCategoryArr" => $parentCategoryArr,
        ];

        return view('pages.admin.sub_category.edit_sub_category')->with('dataArr', $dataArr);
    }

    /**
     * sub category update
     * @param int $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function subCategoryUpdate(Request $request, $id)
    {
        $categoryArr = Category::find($id);

        $request->validate([
            'name' => 'required',
            'parent_id' => 'required',
        ]);


        $slug = str_slug($request->name) . "-" . $id;
        $updateArray['name'] = $request->name;
        $updateArray['slug'] = $slug;
        $updateArray['parent_id'] = $request->parent_id;
        $categoryArr->update($updateArray);

        return redirect()->route('admin.sub.category')->with([
            "message" => [
                "result" => "success",
                "msg" => "Sub Category updated successfully."
            ]
        ]);
    }

    /**
     * sub category remove
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function subCategoryRemove($id)
    {
        Category::find($id)->delete();

        return redirect()->route('admin.sub.category')->with([
            "message" => [
                "result" => "success",
                "msg" => "Sub Category deleted successfully."
            ]
        ]);
    }
}
