<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends BaseController
{

    /**
     * Brand listing
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $brandArr = Brand::orderBy('created_at', 'DESC')->get();

        $dataArr = [
            "page_title" => "Brand",
            "brandArr" => $brandArr
        ];

        return view('pages.admin.brand.index')->with('dataArr', $dataArr);
    }

    /**
     * Brand add page
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function brandAdd()
    {
        $dataArr = [
            "page_title" => "Add Brand",
        ];

        return view('pages.admin.brand.add_brand')->with('dataArr', $dataArr);
    }

    /**
     * Brand store
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function brandInsert(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Brand::create([
            'name' => $request->name
        ]);

        return redirect()->route('admin.brand')->with([
            "message" => [
                "result" => "success",
                "msg" => "Brand added successfully."
            ]
        ]);
    }

    /**
     * Brand edit page
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function brandEdit($id)
    {
        $brandArr = Brand::find($id);
        $dataArr = [
            "page_title" => "Edit Brand",
            "brandArr" => $brandArr
        ];

        return view('pages.admin.brand.edit_brand')->with('dataArr', $dataArr);
    }

    /**
     * Brand update
     * @param int $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function brandUpdate(Request $request, $id)
    {
        $brandArr = Brand::find($id);

        $request->validate([
            'name' => 'required',
        ]);


        $updateArray['name'] = $request->name;
        Brand::find($id)->update($updateArray);

        return redirect()->route('admin.brand')->with([
            "message" => [
                "result" => "success",
                "msg" => "Brand updated successfully."
            ]
        ]);
    }

    /**
     * Brand remove
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function brandRemove($id)
    {
        Brand::find($id)->delete();

        return redirect()->route('admin.brand')->with([
            "message" => [
                "result" => "success",
                "msg" => "Brand deleted successfully."
            ]
        ]);
    }
}
