<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\OnlineTrainingBooking;
use App\Models\Transaction;
use App\Models\Setting;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingCancelMail;
use Stripe\Stripe;
use Stripe\Refund;

class OnlineTrainingOrderController extends BaseController
{

    /**
     * orders listing
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $bookingArr = OnlineTrainingBooking::orderBy('created_at', 'DESC')->get();

        $dataArr = [
            "page_title" => "Online Training Orders",
            "bookingArr" => $bookingArr
        ];

        return view('pages.admin.booking.online_training_order')->with('dataArr', $dataArr);
    }

    /**
     * order detail
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function view($booking_id)
    {
        $bookingDetail = OnlineTrainingBooking::find($booking_id);

        $dataArr = [
            "page_title" => "Online Training Order Detail",
            "bookingDetail" => $bookingDetail
        ];

        return view('pages.admin.booking.online_training_order_detail')->with('dataArr', $dataArr);
    }

    /**
     * order Status
     * @param int $id
     * @param mix $status
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function orderStatus($id, $status)
    {
        $booking = OnlineTrainingBooking::find($id);
        $setting = Setting::first();
        $status_msg = "Order " . $status . " successfully.";

        if ($status == 'cancel') {
            // $gateway = $this->braintreeInit();

            // $refund_price = floatval(number_format($booking->total_amount, 2));

            // $result = $gateway->transaction()->refund($booking->transaction_id, [
            //     'amount' => $refund_price,
            //     'orderId' => $booking->booking_number
            // ]);

            // if (!$result->success) {
            //     $err_msg = "An error occurred with the message: " . $result->message;
            //     if ($result->message == 'Cannot refund transaction unless it is settled.') {
            //         $err_msg = "Cannot refund transaction unless it is settled. It will take upto 2 hours approximately.";
            //     }
            //     return back()->with([
            //         "message" => [
            //             "result" => "error",
            //             "msg" => $err_msg
            //         ]
            //     ]);
            // }

            // $refund_price = round($booking->total_amount, 2);
            $refund_charge = ($setting->refund_charge / 100) * $booking->total_amount;
            $refund_price = round($booking->total_amount - $refund_charge, 2);

            Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
            $result = Refund::create(array(
                'charge' => $booking->transaction_id,
                'amount' => $refund_price*100,
            ));

            // $transaction_id = $result->transaction->id;
            $transaction_id = $result['id'];
            Transaction::create([
                'transaction_id' => $transaction_id,
                'booking_id' => $id,
                'amount' => $booking->total_amount,
                'type' => "Dedited",
                'booking_for' => "Online Training",
                'transaction_date' => date('Y-m-d')
            ]);
            $status = 'refunded';
            $status_msg = 'Order cancelled successfully & will be refunded in 5-10 days.';
        }
        $booking->update([
            'status_date' => date('Y-m-d H:i:s'),
            'status' => $status
        ]);
        $this->sendMail($booking->id, $status);

        return redirect()->route('admin.online.training.order')->with([
            "message" => [
                "result" => "success",
                "msg" => $status_msg
            ]
        ]);
    }

    /**
     * send Mail
     * @param mixed $bookingId
     * @return void
     */
    public function sendMail($bookingId, $status)
    {
        $mail_subject = "";
        if ($status == 'refunded')
            $mail_subject = 'Order Cancelled';
        else
            $mail_subject = 'Order Delivered';

        $bookingDetails = OnlineTrainingBooking::find($bookingId);
        $bookingDetail                     =   [];
        $bookingDetail['mail_subject']     =   $mail_subject;
        $bookingDetail['email']            =   $bookingDetails->email;
        $bookingDetail['booking_detail']   =   $bookingDetails;
        $bookingDetail['status']           =   $status;
        $bookingDetail['type']             =   "onine_training";

        Mail::send(new BookingCancelMail($bookingDetail));
    }
}
