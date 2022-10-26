<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\Setting;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingCancelMail;
use Stripe\Stripe;
use Stripe\Refund;

class OrderController extends BaseController
{

    /**
     * orders listing
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $bookingArr = Booking::orderBy('created_at', 'DESC')->get();

        $dataArr = [
            "page_title" => "Orders",
            "bookingArr" => $bookingArr
        ];

        return view('pages.admin.booking.index')->with('dataArr', $dataArr);
    }

    /**
     * order detail
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function view($booking_id)
    {
        $bookingDetail = Booking::find($booking_id);

        $dataArr = [
            "page_title" => "Order Detail",
            "bookingDetail" => $bookingDetail
        ];

        return view('pages.admin.booking.order_detail')->with('dataArr', $dataArr);
    }

    /**
     * order Status
     * @param int $id
     * @param mix $status
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function orderStatus($id, $status)
    {
        $booking = Booking::find($id);
        $setting = Setting::first();
        $status_msg = "Order " . $status . " successfully.";
        $refund_charge = "0.00";
        if ($status == 'cancel') {
            // $gateway = $this->braintreeInit();
            // $refund_price = floatval(number_format($booking->total_amount - $refund_charge, 2));
            // $result = $gateway->transaction()->refund($booking->transaction_id, [
            //     'amount' => $refund_price,
            //     'orderId' => $booking->booking_number
            // ]);

            $refund_charge = ($setting->refund_charge / 100) * $booking->total_amount;
            $refund_price = round($booking->total_amount - $refund_charge, 2);

            Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
            $result = Refund::create(array(
                'charge' => $booking->transaction_id,
                'amount' => $refund_price*100,
            ));


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

            // $transaction_id = $result->transaction->id;
            $transaction_id = $result['id'];
            Transaction::create([
                'transaction_id' => $transaction_id,
                'booking_id' => $id,
                'amount' => $booking->total_amount,
                'type' => "Dedited",
                'booking_for' => "Items",
                'transaction_date' => date('Y-m-d')
            ]);
            $status = 'refunded';
            $status_msg = 'Order cancelled successfully & will be refunded in 5-10 days.';
        }
        $bookingDetails = BookingDetail::where('booking_id', $id)->get();
        foreach ($bookingDetails as $data) {
            Product::find($data->product_id)->increment('quantity', $data->quantity);
        }
        $booking->update([
            'status_date' => date('Y-m-d H:i:s'),
            'status' => $status,
            'refund_charge' => $refund_charge,
        ]);
        $this->sendMail($booking->id, $status);

        return redirect()->route('admin.order')->with([
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

        $bookingDetails = Booking::with('getBookingDetail.getProductDetail')->find($bookingId);
        $bookingDetail                     =   [];
        $bookingDetail['mail_subject']     =   $mail_subject;
        $bookingDetail['email']            =   $bookingDetails->getUserDetail->email;
        $bookingDetail['booking_detail']   =   $bookingDetails;
        $bookingDetail['status']           =   $status;

        Mail::send(new BookingCancelMail($bookingDetail));
    }
}
