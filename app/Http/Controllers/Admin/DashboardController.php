<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController as BaseController;
use App\Models\Enquiry;

class DashboardController extends BaseController
{
    public function index()
    {
        $enquiryArr = Enquiry::orderBy('created_at', 'DESC')->get();

        $dataArr = [
            "page_title" => "Dashboard",
            "enquiryArr" => $enquiryArr
        ];

        return view('pages.admin.dashboard.index')->with('dataArr', $dataArr);
    }
}
