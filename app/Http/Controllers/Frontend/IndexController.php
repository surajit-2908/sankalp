<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\BaseController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use App\Models\Product;
use App\Models\OnlineTraining;
use App\Models\OnlineTrainingBooking;
use App\Models\Transaction;
use App\Models\ContactUs;
use App\Models\Testimonial;
use App\Models\Setting;
use App\Models\Content;
use App\User;
use Session;
use DB;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OnlineTrainingBookingSuccessMail;
use App\Mail\ContactEmail;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;

class IndexController extends BaseController
{

    /**
     * Home page
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $productArr = Product::where(['featured' => '1', 'status' => '1'])->orderBy('created_at', 'DESC')->get();
        $onlineTrainingArr = OnlineTraining::where('video', '!=', "")->orderBy('created_at', 'DESC')->get();
        $testimonialArr = Testimonial::orderBy('created_at', 'DESC')->get();

        $banner['top'] = Content::where(['page' => 'home', 'position' => 'top_banner'])->first();
        $banner['middle'] = Content::where(['page' => 'home', 'position' => 'middle_banner'])->first();
        $banner['bottom'] = Content::where(['page' => 'home', 'position' => 'bottom_banner'])->first();

        return view('pages.frontend.index', compact('onlineTrainingArr', 'productArr', 'testimonialArr', 'banner'));
    }

    /**
     * about page
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function about()
    {
        $testimonialArr = Testimonial::orderBy('created_at', 'DESC')->get();
        $banner['top'] = Content::where(['page' => 'about', 'position' => 'top_banner'])->first();
        $banner['middle'] = Content::where(['page' => 'about', 'position' => 'middle_banner'])->first();
        $banner['bottom'] = Content::where(['page' => 'about', 'position' => 'bottom_banner'])->first();
        return view('pages.frontend.about', compact('testimonialArr', 'banner'));
    }

    /**
     * contact-us page
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function contact()
    {
        $setting = Setting::first();
        $banner['top'] = Content::where(['page' => 'contact', 'position' => 'top_banner'])->first();
        return view('pages.frontend.contact', compact('setting', 'banner'));
    }

    /**
     * contact-us save
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function saveContact(Request $request)
    {
        $this->validate($request, [
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'msg' => 'required',
        ]);

        ContactUs::create([
            "name" => $request->fname . " " . $request->lname,
            "email" => $request->email,
            "phone" => $request->phone,
            "msg" => $request->msg
        ]);

        $contactDetails                  =   [];
        $contactDetails['name']          =   $request->fname . " " . $request->lname;
        $contactDetails['email']         =   $request->email;
        $contactDetails['phone']         =   $request->phone;
        $contactDetails['msg']           =   $request->msg;
        Mail::send(new ContactEmail($contactDetails));

        return redirect()->back()->with([
            "message" => [
                "result" => "success",
                "msg" => "Your message has been sent successfully."
            ]
        ]);
    }

    /**
     * online Training page
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function onlineTraining()
    {
        $onlineTrainingArr = OnlineTraining::where('bottom_item', '0')->orderBy('created_at', 'DESC')->get();
        $onlineTrainingBtmArr = OnlineTraining::where('bottom_item', '1')->orderBy('created_at', 'DESC')->get();
        return view('pages.frontend.online_training', compact('onlineTrainingArr', 'onlineTrainingBtmArr'));
    }

    /**
     * online Training payment page
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function payment(Request $request)
    {
        Session::put('all_req', $request->all());
        $onlineTraining = OnlineTraining::find($request->online_training_id);

        $gateway = self::braintreeInit();
        $token = $gateway->clientToken()->generate([
            "customerId" => Auth::user()->customer_id
        ]);
        return view('pages.frontend.online_training_payment', compact('token', 'onlineTraining'));
    }
    // /**
    //  * braintree payment gateway
    //  * @param mixed $nonce
    //  * @param mixed $amount
    //  * @return \Braintree\Result\Successful|\Braintree\Result\Error
    //  */
    // public function braintreePayment($nonce, $amount, $input, $bookingNumber)
    // {
    //     $gateway = $this->braintreeInit();

    //     if (Auth::user()->customer_id) {
    //         $result = $gateway->transaction()->sale([
    //             'amount' => $amount,
    //             'paymentMethodNonce' => $nonce,
    //             'customerId' => Auth::user()->customer_id,
    //             'options' => [
    //                 'submitForSettlement' => true
    //             ],
    //             'customFields' => [
    //                 'order_id' => $bookingNumber
    //             ]
    //         ]);
    //     } else {
    //         $result = $gateway->transaction()->sale([
    //             'amount' => $amount,
    //             'paymentMethodNonce' => $nonce,
    //             'customer' => [
    //                 'firstName' => $input['name'],
    //                 'lastName' => "",
    //                 'email' =>  $input['email'],
    //                 'phone' => $input['phone'],
    //             ],
    //             'options' => [
    //                 'submitForSettlement' => true,
    //                 'storeInVaultOnSuccess' => true,
    //             ],
    //             'customFields' => [
    //                 'order_id' => $bookingNumber
    //             ]
    //         ]);
    //     }
    //     $customer_id = $result->transaction->customer['id'];
    //     if ($customer_id)
    //         User::find(Auth::id())->update(['customer_id' => $customer_id]);

    //     return $result;
    // }

    /**
     * booking
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function booking(Request $request, $id)
    {
        $payload = $request->all();
        // $payload = $request->input('payload', false);
        // $nonce = $payload['nonce'];

        try {
            DB::beginTransaction();
            $onlineTrainingData = OnlineTraining::find($id);
            $input = Session::get('all_req');

            $bookingNumber = "HF" . self::generateOtp(6);
            $totalAmount = round($onlineTrainingData->selling_price, 2);
            $result = $this->stripePayment($payload, $totalAmount * 100, $bookingNumber);

            // $totalAmount = number_format($onlineTrainingData->selling_price, 2);
            // $result = $this->braintreePayment($nonce, $totalAmount, $input, $bookingNumber);

            // if (!$result->success)
            //     return response()->json($result);

            $booking = OnlineTrainingBooking::create([
                'user_id' => Auth::id(),
                'online_training_id' => $input['online_training_id'],
                'booking_number' => $bookingNumber,
                'name' => $input['name'],
                'email' => $input['email'],
                'phone' => $input['phone'],
                'address' => $input['address'],
                'msg' => $input['msg'],
                'total_amount' => $totalAmount,
                'status' => 'active',
            ]);
            Session::forget('all_req');

            // $transaction_id = $result->transaction->id;
            $transaction_id = $result['id'];
            Transaction::create([
                'transaction_id' => $transaction_id,
                'booking_id' => $booking->id,
                'amount' => $totalAmount,
                'type' => "Credited",
                'booking_for' => "Online Training",
                'status_date' => date('Y-m-d')
            ]);

            $booking->update([
                'transaction_id' => $transaction_id,
                'status_date' => date('Y-m-d')
            ]);

            $this->sendMail($booking, $onlineTrainingData);
            $this->sendAdminMail($booking, $onlineTrainingData);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }

        // return response()->json($result);
        return redirect()->route('booking.success', ['online-training']);
    }

    /**
     * stripe payment gateway
     * @param array $request
     * @param mixed $amount
     * @param mixed $bookingNumber
     * @return \Braintree\Result\Successful|\Braintree\Result\Error
     */
    public function stripePayment($request, $amount, $bookingNumber)
    {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $customer = Customer::create(array(
            'name' => $request['name'],
            'email' => $request['stripeEmail'],
            'source' => $request['stripeToken']
        ));

        $charge = Charge::create(array(
            'customer' => $customer->id,
            'amount' => $amount,
            'currency' => 'usd',
            'description' => 'Booking number is ' . $bookingNumber,
        ));

        return $charge;
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

        Mail::send(new OnlineTrainingBookingSuccessMail($bookingDetail));
    }

    /**
     * send Mail to admin
     * @param mixed $booking
     * @param mixed $onlineTrainingData
     * @return void
     */
    public function sendAdminMail($booking, $onlineTrainingData)
    {
        $bookingDetail                     =   [];
        $bookingDetail['mail_subject']     =   "New Online Training Booking";
        $bookingDetail['email']            =   env('ADMIN_EMAIL');
        $bookingDetail['booking_detail']   =   $booking;
        $bookingDetail['training_data']    =   $onlineTrainingData;

        Mail::send(new OnlineTrainingBookingSuccessMail($bookingDetail));
    }
}
