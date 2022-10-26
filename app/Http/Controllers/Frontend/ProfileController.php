<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use App\User;
use App\Models\UserAddress;
use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\OnlineTrainingBooking;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Storage;
use DB;
use Session;

class ProfileController extends BaseController
{

    /**
     * Home page
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        return view('pages.frontend.profile.index');
    }

    /**
     * update profile
     * @param \Illuminate\Http\Request $request
     * @return string|\Illuminate\Http\RedirectResponse
     */
    public function updateProflie(Request $request)
    {
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            // 'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
        ]);

        try {
            User::find(Auth::id())->update([
                'fname' => $request->fname,
                'lname' => $request->lname,
                // 'email' => $request->email,
                'phone' => $request->phone,
                'gender' => $request->gender == 'm' ? 'm' : 'f'
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return redirect()->back()->with([
            "message" => [
                "result" => "success",
                "msg" => "Profile updated successfully."
            ]
        ]);
    }

    public function updateImage(Request $request)
    {
        $response = [
            'jsonrpc' => '2.0'
        ];

        try {

            DB::beginTransaction();

            $uploadedFile = $request->profile_pic;
            $filename = time() . $uploadedFile->getClientOriginalName();

            if (!Storage::makeDirectory('public/' . self::USER_PIC)) {
                throw new \Exception('Could not create the directory');
            }
            if (!is_null(Auth::user()->image)) {
                Storage::disk('public')->delete(self::USER_PIC . '/' . Auth::user()->image);
            }

            Storage::disk('public')->putFileAs(
                self::USER_PIC,
                $uploadedFile,
                $filename
            );

            $updateArray['image'] = $filename;
            User::find(Auth::id())->update($updateArray);


            DB::commit();

            $destinationPath = "public/storage/user_image/";
            $response['result']['success'] = 'Your profile pic is uploaded.';
            $response['result']['profile_pic'] = url($destinationPath . $filename);

            return response()->json($response);
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }


    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|min:6',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:new_password',
        ]);

        $userArr = Auth::user();
        if (Hash::check($request->current_password, $userArr->password)) {
            $updateArray['password'] = bcrypt($request->confirm_password);
            User::find(Auth::id())->update($updateArray);

            $result = "success";
            $message = 'Password changed successfully';
        } else {
            $result = "error";
            $message = 'Incorrect current password';
        }

        return redirect()->back()
            ->with([
                "message" => [
                    "result" => $result,
                    "msg" => $message
                ]
            ]);
    }


    /**
     * my orders page
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function myOrder(Request $request)
    {
        $bookingId = [];
        if ($request->search) {
            $bookingId = Booking::where('user_id', Auth::id())
                ->where('booking_number', $request->search)->pluck('id');
        } else {
            $bookingId = Booking::where('user_id', Auth::id())->pluck('id');
        }
        $orders = BookingDetail::whereIn('booking_id', $bookingId)->OrderByDesc('created_at')->paginate(10);


        return view('pages.frontend.profile.my_orders', compact('orders'));
    }


    /**
     * online Training Order page
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function onlineTrainingOrder(Request $request)
    {
        if ($request->search) {
            $orders = OnlineTrainingBooking::where('user_id', Auth::id())
                ->where('booking_number', $request->search)->OrderByDesc('created_at')->paginate(10);
        } else {
            $orders = OnlineTrainingBooking::where('user_id', Auth::id())->OrderByDesc('created_at')->paginate(10);
        }

        return view('pages.frontend.profile.online_training_orders', compact('orders'));
    }


    /**
     * manage address page
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function manageAddress()
    {
        $userAddresses = UserAddress::whereUserId(Auth::id())->orderByDesc('created_at')->get();
        return view('pages.frontend.profile.manage_address', compact('userAddresses'));
    }

    /**
     * add address
     * @param \Illuminate\Http\Request $request
     * @return string|\Illuminate\Http\RedirectResponse
     */
    public function insertAddress(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pincode' => 'required',
            'address' => 'required',
            'type' => 'required',
        ]);

        try {
            $userAdd  = UserAddress::whereUserId(Auth::id())->count();
            if ($userAdd)
                $is_default = '0';
            else
                $is_default = '1';


            $landmark =  $request->landmark ? $request->landmark . ', ' : '';
            $complete_address =  $request->address . ', ' . $landmark . $request->city . ', ' . $request->state . ', ' . $request->pincode;
            UserAddress::create([
                'user_id' => Auth::id(),
                'name' => $request->name,
                'phone' => $request->phone,
                'state' => $request->state,
                'city' => $request->city,
                'pincode' => $request->pincode,
                'landmark' => $request->landmark,
                'address' => $request->address,
                'complete_address' => $complete_address,
                'is_default' => $is_default,
                'type' => $request->type == "Home" ? 'Home' : 'Office',
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        if (Session::get('addAddr')) {
            Session::forget('addAddr');
            return redirect()->route('check.out');
        } else {
            return redirect()->back()->with([
                "message" => [
                    "result" => "success",
                    "msg" => "Address added successfully."
                ]
            ]);
        }
    }

    /**
     * edit address ajax page
     * @param integer $address_id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function editAddress($address_id)
    {
        $userAdd = UserAddress::find($address_id);
        return view('pages.frontend.profile.ajax_edit_address', compact('userAdd', 'address_id'));
    }

    /**
     * update address
     * @param \Illuminate\Http\Request $request
     * @param mixed $id
     * @return string|\Illuminate\Http\RedirectResponse
     */
    public function updateAddress(Request $request, $address_id)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pincode' => 'required',
            'address' => 'required',
            'type' => 'required',
        ]);

        try {
            $landmark =  $request->landmark ? $request->landmark . ', ' : '';
            $complete_address =  $request->address . ', ' . $landmark . $request->city . ', ' . $request->state . ', ' . $request->pincode;
            UserAddress::find($address_id)->update([
                'user_id' => Auth::id(),
                'name' => $request->name,
                'phone' => $request->phone,
                'state' => $request->state,
                'city' => $request->city,
                'pincode' => $request->pincode,
                'landmark' => $request->landmark,
                'address' => $request->address,
                'complete_address' => $complete_address,
                'type' => $request->type == "Home" ? 'Home' : 'Office',
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return redirect()->back()->with([
            "message" => [
                "result" => "success",
                "msg" => "Address updated successfully."
            ]
        ]);
    }

    /**
     * update address mobile
     * @param \Illuminate\Http\Request $request
     * @param mixed $id
     * @return string|\Illuminate\Http\RedirectResponse
     */
    public function updateMobile(Request $request, $address_id)
    {
        $request->validate([
            'phone' => 'required',
        ]);

        $response = [
            'jsonrpc'   => '2.0'
        ];

        try {
            $userAddress = UserAddress::find($address_id);
            if ($userAddress->phone != $request->phone)
                $userAddress->update(['phone' => $request->phone]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        $response['status'] = "success";
        return response()->json($response, 200);
    }

    /**
     * remove address
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeAddress(Request $request)
    {
        $response = [
            'jsonrpc'   => '2.0'
        ];

        $userAdd = UserAddress::find($request->add_id);
        $userAdd->delete();

        $userAdd  = UserAddress::whereUserId(Auth::id())->count();
        if ($userAdd == 1)
            UserAddress::whereUserId(Auth::id())->update(['is_default' => '1']);

        $response['status'] = "success";
        $response['user_count'] = $userAdd;
        return response()->json($response, 200);
    }

    /**
     * remove address
     * @param mixed $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function addressDefault($id)
    {
        UserAddress::whereUserId(Auth::id())->update(['is_default' => '0']);
        UserAddress::find($id)->update(['is_default' => '1']);

        return redirect()->back()->with([
            "message" => [
                "result" => "success",
                "msg" => "Default address updated successfully."
            ]
        ]);
    }
}
