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
}
