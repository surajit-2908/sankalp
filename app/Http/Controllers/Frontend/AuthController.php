<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use DB;
use Session;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordResetMail;
use App\Mail\MailVerify;

class AuthController extends BaseController
{

    public function __construct()
    {
        $this->middleware('guest')->except('logoutUser');
    }

    /**
     * login page
     * @param mixed $slug
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function login($slug = null)
    {
        if ($slug) {
            Session::put('slug', $slug);
        }
        return view('pages.frontend.login');
    }

    /**
     * login user
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function loginUser(Request $request)
    {
        $request->validate([
            'email'     => ['required', 'string', 'email', 'max:255'],
            'password'  => ['required', 'string', 'min:4']
        ]);

        try {

            $loginData = [
                'email'     => $request->email,
                'password'  => $request->password,
                'status'  => '1'
            ];

            if (!Auth::attempt($loginData)) {
                return redirect()->back()->with([
                    "message" => [
                        "result" => "error",
                        "msg" => "Invalid Credentials"
                    ]
                ]);
            } else {
                if (Session::has('slug')) {
                    $slug = Session::get('slug');
                    if ($slug == "online-training") {
                        Session::forget('slug');
                        return redirect()->route('online.training');
                    } else {
                        Session::forget('slug');
                        return redirect()->route('product.detail', $slug);
                    }
                } else {
                    return redirect()->route('index');
                }
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * signUp page
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function signUp()
    {
        return view('pages.frontend.sign-up');
    }

    /**
     * email verify
     * @param integer $email
     * @return \Illuminate\Http\JsonResponse
     */
    public function emailVerify($email)
    {
        $response = [
            'jsonrpc'   => '2.0'
        ];

        $user = User::whereEmail($email)->first();
        if ($user) {
            $response['email_exist'] = true;
            return response()->json($response);
        }

        $otp = self::generateOtp(6);
        Session::put('otp', $otp);
        $this->sendMailVerify($email, $otp);

        $response['status'] = "success";
        $response['otp'] = $otp;
        return response()->json($response);
    }


    /**
     * send Mail
     * @param mixed $userDetails
     * @param mixed $otp
     * @return void
     */
    public function sendMailVerify($email, $otp)
    {
        $detail                     =   [];
        $detail['mail_subject']     =   "Email Verify";
        $detail['email']              =   $email;
        $detail['otp']              =   $otp;

        Mail::send(new MailVerify($detail));
    }

    /**
     * signUp user
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function signupUser(Request $request)
    {
        $request->validate([
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'email_otp' => ['required'], //, 'confirmed'
            'password' => ['required', 'string', 'min:6'], //, 'confirmed'
        ]);

        try {
            if (Session::get('otp') != $request->email_otp) {
                return redirect()->back()->withInput($request->input())->with([
                    "invalid_otp" => true,
                    "message" => [
                        "result" => "error",
                        "msg" => "Invalid Otp."
                    ]
                ]);
            }
            DB::beginTransaction();

            User::create([
                'fname'         => @$request->fname,
                'lname'         => @$request->lname,
                'email'         => $request->email,
                'password'      => bcrypt($request->password)
            ]);

            DB::commit();
            return redirect()->route('user.login')->with([
                "message" => [
                    "result" => "success",
                    "msg" => "Registeed successfully."
                ]
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    /**
     * forgot password page
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function forgotPassword()
    {
        return view('pages.frontend.forgot_password');
    }

    /**
     * forgot password page
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email'     => ['required', 'string', 'email', 'max:255']
        ]);
        $userDetails = User::where('email', $request->email)->first();

        if (!$userDetails) {
            return redirect()->back()->with([
                "message" => [
                    "result" => "error",
                    "msg" => "Invalid email address"
                ]
            ]);
        } else {
            try {

                DB::beginTransaction();

                $otp = $this->generateOtp(6);
                $this->sendMail($userDetails, $otp);

                $updateArray['otp']        = $otp;
                $userDetails->update($updateArray);

                DB::commit();
                return redirect()->back()->with([
                    "message" => [
                        "result" => "success",
                        "msg" => "Mail successfully sent with reset password link"
                    ]
                ]);
            } catch (\Exception $e) {
                DB::rollback();
                return $e->getMessage();
            }
        }
    }

    /**
     * reset password page
     * @param mixed $otp
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse
     */
    public function resetNewPassword($otp)
    {
        $decryptOTP = Crypt::decryptString($otp);
        $user = User::where('otp', $decryptOTP)->first();
        if (!$user) {
            return redirect()->intended(route('forgot.password'))->with([
                "message" => [
                    "result" => "error",
                    "msg" => "Invalid link, please Try agin"
                ]
            ]);
        } else {
            return view('pages.frontend.reset_password', compact('user', 'otp'));
        }
    }

    /**
     * update forgot password
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateForgotPassword(Request $request)
    {
        $this->validate($request, [
            'otp'           => 'required',
            'new_password'      => 'min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password'  => 'min:6'
        ]);

        $decryptOTP = Crypt::decryptString($request->otp);
        $user = User::where('otp', $decryptOTP)->first();

        $updateArray['otp']        = "";
        $updateArray['password']   = bcrypt($request->new_password);
        $updatePsw = $user->update($updateArray);

        if ($updatePsw) {
            return redirect()->intended(route('user.login'))->with([
                "message" => [
                    "result" => "success",
                    "msg" => "Password changed successfully"
                ]
            ]);
        } else {
            return redirect()->back()->with([
                "message" => [
                    "result" => "error",
                    "msg" => "Something went wrong"
                ]
            ]);
        }
    }

    /**
     * send Mail
     * @param mixed $userDetails
     * @param mixed $otp
     * @return void
     */
    public function sendMail($userDetails, $otp)
    {
        $encryptedOTP = Crypt::encryptString($otp);

        $userDetail                     =   [];
        $userDetail['mail_subject']     =   "Reset Password";
        $userDetail['otp']              =   $encryptedOTP;
        $userDetail['email']            =   $userDetails->email;
        $userDetail['user_detail']      =   $userDetails;

        Mail::send(new PasswordResetMail($userDetail));
    }

    /**
     * logout user
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function logoutUser()
    {
        Auth::logout();
        return redirect()->route('user.login')->with([
            "message" => [
                "result" => "success",
                "msg" => "Logged out successfully."
            ]
        ]);
    }
}
