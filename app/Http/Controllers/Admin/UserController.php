<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController as BaseController;
use App\User;

class UserController extends BaseController
{

    /**
     * user listing
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $userArr = User::orderByDesc('created_at')->get();

        $dataArr = [
            "page_title" => "User",
            "userArr" => $userArr
        ];

        return view('pages.admin.user.index')->with('dataArr', $dataArr);
    }


    /**
     * change user status
     * @param integer $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function userStatus($id)
    {
        $user = User::find($id);

        $status = $user->status ? "0" : "1";

        $updateArr['status'] = $status;
        $user->update($updateArr);

        return redirect()->back()->with([
            "message" => [
                "result" => "success",
                "msg" => "User status changed successfully."
            ]
        ]);
    }
}
