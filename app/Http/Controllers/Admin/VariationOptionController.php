<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\VariationOption;
use App\Models\Variation;

class VariationOptionController extends BaseController
{

    /**
     * Variation option listing
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $VariationOptionArr = VariationOption::orderBy('created_at', 'DESC')->get();

        $dataArr = [
            "page_title" => "Variation Option",
            "VariationOptionArr" => $VariationOptionArr
        ];

        return view('pages.admin.variation_option.index')->with('dataArr', $dataArr);
    }

    /**
     * Variation option add page
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function variationOptionAdd()
    {
        $variationArr = Variation::OrderBy('name')->get();
        $dataArr = [
            "page_title" => "Add Variation Option",
            "variationArr" => $variationArr
        ];

        return view('pages.admin.variation_option.add_variation_option')->with('dataArr', $dataArr);
    }

    /**
     * Variation option store
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function variationOptionInsert(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'variation_id' => 'required',
        ]);

        VariationOption::create([
            'name' => $request->name,
            'variation_id' => $request->variation_id
        ]);

        return redirect()->route('admin.variation.option')->with([
            "message" => [
                "result" => "success",
                "msg" => "Variation Option added successfully."
            ]
        ]);
    }

    /**
     * Variation option edit page
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function variationOptionEdit($id)
    {
        $VariationOptionArr = VariationOption::find($id);
        $variationArr = Variation::OrderBy('name')->get();
        $dataArr = [
            "page_title" => "Edit Variation Option",
            "VariationOptionArr" => $VariationOptionArr,
            "variationArr" => $variationArr,
        ];

        return view('pages.admin.variation_option.edit_variation_option')->with('dataArr', $dataArr);
    }

    /**
     * Variation option update
     * @param int $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function variationOptionUpdate(Request $request, $id)
    {
        $variationArr = VariationOption::find($id);

        $request->validate([
            'name' => 'required',
            'variation_id' => 'required',
        ]);


        $updateArray['name'] = $request->name;
        $updateArray['variation_id'] = $request->variation_id;
        VariationOption::find($id)->update($updateArray);

        return redirect()->route('admin.variation.option')->with([
            "message" => [
                "result" => "success",
                "msg" => "Variation Option updated successfully."
            ]
        ]);
    }

    /**
     * Variation option remove
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function variationOptionRemove($id)
    {
        VariationOption::where('variation_id', $id)->delete();
        VariationOption::find($id)->delete();

        return redirect()->route('admin.variation.option')->with([
            "message" => [
                "result" => "success",
                "msg" => "Variation Option deleted successfully."
            ]
        ]);
    }
}
