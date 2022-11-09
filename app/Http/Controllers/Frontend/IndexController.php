<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\BaseController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use App\Models\Enquiry;
use App\Models\Order;
use App\Models\Tracking;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactEmail;

class IndexController extends BaseController
{

    /**
     * Home page
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        return view('pages.frontend.index');
    }

    /**
     * enquiry page
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function enquiry()
    {
        return view('pages.frontend.enquiry');
    }

    /**
     * enquiry save
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function saveEnquiry(Request $request)
    {
        $this->validate(
            $request,
            [
                'company_name' => 'required',
                'key_person' => 'required',
                'email' => 'required|email',
                'country' => 'required',
                'phone' => 'required',
                'industry' => 'required',
                'enquiry' => 'required',
                'captcha' => 'required|captcha'
            ],
            ['captcha.captcha' => 'Invalid captcha code.']
        );
        if (captcha_check($request->captcha) == false) {
            return redirect()->back()->with([
                "message" => [
                    "result" => "error",
                    "msg" => "Invalid captcha code."
                ]
            ]);
        }
        $input = $request->all();

        Enquiry::create($input);

        // $contactDetails                  =   [];
        // $contactDetails['name']          =   $request->fname . " " . $request->lname;
        // $contactDetails['email']         =   $request->email;
        // $contactDetails['phone']         =   $request->phone;
        // $contactDetails['msg']           =   $request->msg;
        // Mail::send(new ContactEmail($contactDetails));

        return redirect()->back()->with([
            "message" => [
                "result" => "success",
                "msg" => "Your message has been sent successfully."
            ]
        ]);
    }
    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img('flat')]);
    }
    /**
     * send Mail
     * @param mixed $booking
     * @param mixed $onlineTrainingData
     * @return void
     */
    public function sendMail($booking, $onlineTrainingData)
    {
        $bookingDetail                     =   [];
        $bookingDetail['mail_subject']     =   "Order Successful";
        $bookingDetail['email']            =   $booking->email;
        $bookingDetail['booking_detail']   =   $booking;
        $bookingDetail['training_data']   =   $onlineTrainingData;

        Mail::send(new ContactEmail($bookingDetail));
    }


    /**
     * showTrackingDetails
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function showTrackingDetails(Request $request)
    {
        $input = $request->all();
        $order = Order::where('invoice_number', $input['invoice_number'])->first();
        if($order)
            Tracking::create($input);

        return view('pages.frontend.ajax_track', compact('order'));
    }
}
