<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController as BaseController;
use App\Models\Tracking;

class TrackingController extends BaseController
{

    /**
     * Enquiry listing
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $trackingArr = Tracking::orderBy('created_at', 'DESC')->get();

        $dataArr = [
            "page_title" => "Tracking",
            "trackingArr" => $trackingArr
        ];

        return view('pages.admin.tracking.index')->with('dataArr', $dataArr);
    }

    /**
     * tracking remove
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function trackingRemove($id)
    {
        Tracking::find($id)->delete();

        return redirect()->back()->with([
            "message" => [
                "result" => "success",
                "msg" => "Tracking deleted successfully."
            ]
        ]);
    }
}
