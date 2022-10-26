<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Setting;
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

    /**
     * settings page
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function setting()
    {
        $settings = Setting::first();
        $dataArr["page_title"] = "Settings";
        $dataArr["settings"] = $settings;
        return view('pages.admin.setting.index', compact('dataArr'));
    }

    /**
     * settings update
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSetting(Request $request, $id)
    {
        $this->validate($request, [
            'vat' => 'required',
            'shipping_charge' => 'required',
            'refund_charge' => 'required',
            'contact_email' => 'required',
            'contact_phone' => 'required',
            'contact_address' => 'required',
        ]);

        Setting::find($id)->update([
            "vat" => $request->vat,
            "shipping_charge" => $request->shipping_charge,
            "refund_charge" => $request->refund_charge,
            "contact_email" => $request->contact_email,
            "contact_phone" => $request->contact_phone,
            "contact_address" => $request->contact_address,
        ]);

        return redirect()->back()
            ->with([
                "message" => [
                    "result" => "success",
                    "msg" => 'Settings updated successfully'
                ]
            ]);
    }
}
