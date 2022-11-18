<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\UserLog;

class SubAdminController extends BaseController
{

    /**
     * sub_admin listing
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $subAdminArr = Admin::where('admin_type', '!=', 'A')->orderBy('created_at', 'DESC')->get();

        $dataArr = [
            "page_title" => "Sub Admin",
            "subAdminArr" => $subAdminArr
        ];

        return view('pages.admin.sub_admin.index')->with('dataArr', $dataArr);
    }

    /**
     * sub_admin add page
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function subAdminAdd()
    {
        $dataArr = [
            "page_title" => "Add Sub Admin",
        ];

        return view('pages.admin.sub_admin.add_sub_admin')->with('dataArr', $dataArr);
    }

    /**
     * sub_admin store
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function subAdminInsert(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required',
        ]);

        Admin::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'admin_type' => 'SA',
        ]);

        return redirect()->route('admin.sub.admin')->with([
            "message" => [
                "result" => "success",
                "msg" => "Sub Admin added successfully."
            ]
        ]);
    }

    /**
     * sub_admin edit page
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function subAdminEdit($id)
    {
        $subAdminArr = Admin::find($id);

        $dataArr = [
            "page_title" => "Edit Sub Admin",
            "subAdminArr" => $subAdminArr
        ];

        return view('pages.admin.sub_admin.edit_sub_admin')->with('dataArr', $dataArr);
    }

    /**
     * sub_admin update
     * @param int $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function subAdminUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:admins,email,' . $id,
        ]);

        $updateArray['name'] = $request->name;
        $updateArray['phone'] = $request->phone;
        $updateArray['email'] = $request->email;
        $updateArray['admin_type'] = 'SA';
        if ($request->password)
            $updateArray['password'] = bcrypt($request->password);
        Admin::find($id)->update($updateArray);

        return redirect()->route('admin.sub.admin')->with([
            "message" => [
                "result" => "success",
                "msg" => "Sub Admin updated successfully."
            ]
        ]);
    }

    /**
     * sub_admin remove
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function subAdminRemove($id)
    {
        Admin::find($id)->delete();
        UserLog::where('user_id', $id)->delete();

        return redirect()->route('admin.sub.admin')->with([
            "message" => [
                "result" => "success",
                "msg" => "Sub Admin deleted successfully."
            ]
        ]);
    }
}
