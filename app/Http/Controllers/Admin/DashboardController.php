<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController as BaseController;
use App\User;

class DashboardController extends BaseController
{
    protected $beauticianModelObj;
    protected $userModelObj;

    public function __construct()
    {
        $this->userModelObj = new User();
    }

    public function index()
    {

        $dataArr = [
            "page_title" => "Dashboard",
        ];

        return view('pages.admin.dashboard.index')->with('dataArr', $dataArr);
    }
}
