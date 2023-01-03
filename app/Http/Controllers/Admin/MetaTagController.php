<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\PageMetaTag;

class MetaTagController extends BaseController
{

    /**
     * Page meta tag listing
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $metaTagArr = PageMetaTag::orderBy('created_at', 'DESC')->get();

        $dataArr = [
            "page_title" => "Meta Tag",
            "metaTagArr" => $metaTagArr
        ];

        return view('pages.admin.meta_tag.index')->with('dataArr', $dataArr);
    }

    /**
     * Page meta tag edit page
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function metaTagEdit($id)
    {
        $metaTagArr = PageMetaTag::find($id);
        $dataArr = [
            "page_title" => "Edit Meta Tag",
            "metaTagArr" => $metaTagArr
        ];

        return view('pages.admin.meta_tag.edit_meta_tag')->with('dataArr', $dataArr);
    }

    /**
     * Page meta tag update
     * @param int $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function metaTagUpdate(Request $request, $id)
    {
        $metaTagArr = PageMetaTag::find($id);

        $request->validate([
            'meta_title' => 'required',
            'meta_keywords' => 'required',
            'meta_description' => 'required',
        ]);

        $updateArray['meta_title'] = $request->meta_title;
        $updateArray['meta_keywords'] = $request->meta_keywords;
        $updateArray['meta_description'] = $request->meta_description;
        PageMetaTag::find($id)->update($updateArray);

        return redirect()->route('admin.meta.tag')->with([
            "message" => [
                "result" => "success",
                "msg" => "Meta Tag updated successfully."
            ]
        ]);
    }
}
