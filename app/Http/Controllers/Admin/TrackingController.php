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
        $tracking = Tracking::find($id);
        $tracking->delete();

        $log = "Tracking of invoice number: " . $tracking->invoice_number . " & email: " . $tracking->email . " at " . date('h:i a, d M Y', strtotime($tracking->created_at)) . " is deleted.";
        Self::insertUserLog($log);

        return redirect()->back()->with([
            "message" => [
                "result" => "success",
                "msg" => "Tracking deleted successfully."
            ]
        ]);
    }
}
