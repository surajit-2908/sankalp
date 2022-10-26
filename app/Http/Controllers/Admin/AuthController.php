<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;
use Validator;
use Route;

class AuthController extends BaseController
{
    public $loginAttempt;

    public function __construct(Admin $admin)
    {
        $this->middleware('guest:admin', ['except' => ['logout']]);
    }

    public function index()
    {
        // Session::flush();
        $this->loginAttempt = (Session::get('attempt')) ? Session::get('attempt') : 0;
        return view('pages.admin.auth.index')->with('login_attempt', $this->loginAttempt);;
    }

    public function login(Request $request)
    {
        // Validate the form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        // Attempt to log the user in
        $loginData = [
            'email' => $request->email,
            'password' => $request->password,
            'status' => '1'
        ];

        if(Auth::guard('admin')->attempt($loginData))
        {
            // if successful, then redirect to their intended location
            return redirect()->intended(route('admin.dashboard'));
        }
        else
        {
            $this->loginAttempt = $request->login_attempt;
            if($this->loginAttempt >= 3)
            {
                return redirect()->intended(route('admin.forgotpassword'))
                ->with([
                    "message" => [
                        "result" => "error",
                        "msg" => "Too many login attempts.')"
                    ]
                ]);
            }

            $this->loginAttempt++;
        }

        // if unsuccessful, then redirect back to the login with the form data
        return redirect()
            ->back()
            ->withInput($request->only('email'))
            ->with([
                "message" => [
                    "result" => "error",
                    "msg" => "Invalid credentials"
                ],
                "attempt" => $this->loginAttempt
            ]);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/administrator');
    }
}
