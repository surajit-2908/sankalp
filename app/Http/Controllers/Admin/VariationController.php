<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Variation;
use App\Models\Category;

class VariationController extends BaseController
{

    /**
     * Variation listing
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $variationArr = Variation::orderBy('created_at', 'DESC')->get();

        $dataArr = [
            "page_title" => "Variation",
            "variationArr" => $variationArr
        ];

        return view('pages.admin.variation.index')->with('dataArr', $dataArr);
    }

    /**
     * Variation add page
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function variationAdd()
    {
        // $parentCategoryArr = Category::where('parent_id', '0')->get();
        $dataArr = [
            "page_title" => "Add Variation",
            // "parentCategoryArr" => $parentCategoryArr
        ];

        return view('pages.admin.variation.add_variation')->with('dataArr', $dataArr);
    }

    /**
     * Variation store
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function variationInsert(Request $request)
    {
        $request->validate([
            'name' => 'required',
            // 'category_id' => 'required',
        ]);

        Variation::create([
            'name' => $request->name,
            // 'category_id' => $request->category_id
        ]);

        return redirect()->route('admin.variation')->with([
            "message" => [
                "result" => "success",
                "msg" => "Variation added successfully."
            ]
        ]);
    }

    /**
     * Variation edit page
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function variationEdit($id)
    {
        $variationArr = Variation::find($id);
        // $parentCategoryArr = Category::where('parent_id', '0')->get();
        $dataArr = [
            "page_title" => "Edit Variation",
            "variationArr" => $variationArr,
            // "parentCategoryArr" => $parentCategoryArr,
        ];

        return view('pages.admin.variation.edit_variation')->with('dataArr', $dataArr);
    }

    /**
     * Variation update
     * @param int $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function variationUpdate(Request $request, $id)
    {
        $variationArr = Variation::find($id);

        $request->validate([
            'name' => 'required',
            // 'category_id' => 'required',
        ]);


        $updateArray['name'] = $request->name;
        // $updateArray['category_id'] = $request->category_id;
        Variation::find($id)->update($updateArray);

        return redirect()->route('admin.variation')->with([
            "message" => [
                "result" => "success",
                "msg" => "Variation updated successfully."
            ]
        ]);
    }

    /**
     * Variation remove
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function variationRemove($id)
    {
        // Variation::where('category_id', $id)->delete();
        Variation::find($id)->delete();

        return redirect()->route('admin.variation')->with([
            "message" => [
                "result" => "success",
                "msg" => "Variation deleted successfully."
            ]
        ]);
    }
}
