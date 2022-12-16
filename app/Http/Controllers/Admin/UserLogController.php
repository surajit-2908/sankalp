<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController as BaseController;
use App\Models\UserLog;

class UserLogController extends BaseController
{

    /**
     * UserLog listing
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index($order_id = null)
    {
        if ($order_id)
            $userLogArr = UserLog::whereOrderId($order_id)->orderBy('created_at', 'DESC')->get();
        else
            $userLogArr = UserLog::orderBy('created_at', 'DESC')->get();

        $dataArr = [
            "page_title" => "User Log",
            "userLogArr" => $userLogArr
        ];

        return view('pages.admin.user_log.index')->with('dataArr', $dataArr);
    }

    /**
     * UserLog remove
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function userLogRemove($id)
    {
        UserLog::find($id)->delete();

        return redirect()->back()->with([
            "message" => [
                "result" => "success",
                "msg" => "User Log deleted successfully."
            ]
        ]);
    }
}
