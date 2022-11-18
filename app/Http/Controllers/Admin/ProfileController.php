<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class ProfileController extends BaseController
{

    public function changePassword(Request $request)
    {
        // Validate the form data
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|confirmed|min:6'
        ]);

        $adminArr = Auth::guard('admin')->user();
        if (Hash::check($request->current_password, $adminArr->password)) {
            $updateArray['password'] = bcrypt($request->password);
            $adminUpd = Admin::find($adminArr->id)->update($updateArray);

            $result = "success";
            $message = 'Password changed successfully';
        } else {
            $result = "error";
            $message = 'Incorrect current password';
        }

        return redirect()->intended(route('admin.dashboard'))
            ->with([
                "message" => [
                    "result" => $result,
                    "msg" => $message
                ]
            ]);
    }

    public function profileUpdate(Request $request)
    {
        // Validate the form data
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
        ]);

        $adminArr = Auth::guard('admin')->user();
        $updateArray['name'] = $request->name;
        $updateArray['phone'] = $request->phone;
        $adminUpd = Admin::find($adminArr->id)->update($updateArray);

        return redirect()->intended(route('admin.dashboard'))
            ->with([
                "message" => [
                    "result" => "success",
                    "msg" => 'Profile Updated successfully'
                ]
            ]);
    }
}
