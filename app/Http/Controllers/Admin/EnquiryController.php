<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Enquiry;

class EnquiryController extends BaseController
{

    /**
     * Enquiry listing
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $enquiryArr = Enquiry::orderBy('created_at', 'DESC')->get();

        $dataArr = [
            "page_title" => "Enquiry",
            "enquiryArr" => $enquiryArr
        ];

        return view('pages.admin.enquiry.index')->with('dataArr', $dataArr);
    }
    /**
     * Enquiry details
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function enquiryView($id)
    {
        $enquiryArr = Enquiry::find($id);

        $dataArr = [
            "page_title" => "Enquiry Details",
            "enquiryArr" => $enquiryArr
        ];

        return view('pages.admin.enquiry.view')->with('dataArr', $dataArr);
    }

    /**
     * Enquiry update
     * @param int $id
     * @param int $status
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function enquiryStatus($id, $status)
    {
        $enquiryArr = Enquiry::find($id);

        $log_status = $enquiryArr->$status ? "Inactive" : "Active";

        $updateArray[$status] = $enquiryArr->$status ? "0" : "1";
        $enquiryArr->update($updateArray);

        $log = "Enquiry of company name: " . $enquiryArr->company_name . ", key person: " . $enquiryArr->key_person . ", email: " . $enquiryArr->email . ", country: " . $enquiryArr->country . ", phone: " . $enquiryArr->phone . ", industry: " . $enquiryArr->industry . ", enquiry: " . $enquiryArr->enquiry . ", " . ucwords(str_replace('_', ' ', $status)) . " updated to " . $log_status;
        Self::insertUserLog($log);

        return redirect()->back()->with([
            "message" => [
                "result" => "success",
                "msg" => "Enquiry status updated successfully."
            ]
        ]);
    }
}
