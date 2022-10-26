<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\BaseController as BaseController;
use App\Models\Cart;
use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\UserAddress;
use App\Models\Transaction;
use App\Models\Setting;
use App\Models\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingSuccessMail;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;

class BookingController extends BaseController
{
    /**
     * check out page
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function checkOut()
    {
        $user_cart = Cart::where(['user_id' => Auth::id()])->get();
        $product_ids = $user_cart->pluck('product_id');
        $notAvailProduct = Product::whereIn('id', $product_ids)->where('quantity', '0')->count();
        if (!count($user_cart) || $notAvailProduct) {
            return redirect()->route('user.cart');
        }
        $userAddresses = UserAddress::whereUserId(Auth::id())->get();
        $setting = Setting::first();
        $sub_total = 0;

        if (count($userAddresses)) {
            return view('pages.frontend.checkout', compact('user_cart', 'sub_total', 'userAddresses', 'setting'));
        } else {
            Session::put('addAddr', 'add_address');
            return redirect()->route('user.manage.address');
        }
    }

    /**
     * payment page
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function payment(Request $request)
    {
        $subTotal = 0;
        $user_cart = Cart::where('user_id', Auth::id())->get();
        $userAddress = UserAddress::find($request->address_id);
        $setting = Setting::first();

        if ($user_cart) {
            foreach ($user_cart as $data) {
                $amount = (float)$data->getProduct->selling_offer_price * (int)$data->quantity;
                $subTotal += $amount;
            }
        }
        // if ($userAddress->phone != $request->phone)
        //     $userAddress->update(['phone' => $request->phone]);

        Session::put('phone', $request->phone);
        Session::put('complete_address', $request->complete_address);
        $gateway = self::braintreeInit();

        $token = $gateway->clientToken()->generate([
            "customerId" => Auth::user()->customer_id
        ]);
        return view('pages.frontend.payment', compact('token', 'subTotal', 'user_cart', 'setting'));
    }

    /**
     * braintree payment gateway
     * @param mixed $nonce
     * @param mixed $amount
     * @return \Braintree\Result\Successful|\Braintree\Result\Error
     */
    public function braintreePayment($nonce, $amount, $bookingNumber)
    {
        $gateway = $this->braintreeInit();

        if (Auth::user()->customer_id) {
            $result = $gateway->transaction()->sale([
                'amount' => $amount,
                'paymentMethodNonce' => $nonce,
                'customerId' => Auth::user()->customer_id,
                'options' => [
                    'submitForSettlement' => true,
                    'storeInVaultOnSuccess' => true,
                ],
                'customFields' => [
                    'order_id' => $bookingNumber
                ]
            ]);
        } else {
            $result = $gateway->transaction()->sale([
                'amount' => $amount,
                'paymentMethodNonce' => $nonce,
                'customer' => [
                    'firstName' => Auth::user()->fname,
                    'lastName' => Auth::user()->lname,
                    'email' =>  Auth::user()->email,
                    'phone' => Auth::user()->phone,
                ],
                'options' => [
                    'submitForSettlement' => true,
                    'storeInVaultOnSuccess' => true,
                ],
                'customFields' => [
                    'order_id' => $bookingNumber
                ]
            ]);
        }
        $customer_id = $result->transaction->customer['id'];
        if ($customer_id)
            User::find(Auth::id())->update(['customer_id' => $customer_id]);

        return $result;
    }

    /**
     * booking
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function booking(Request $request)
    {
        $payload = $request->all();
        // $payload = $request->input('payload', false);
        // $nonce = $payload['nonce'];

        try {
            DB::beginTransaction();
            $subTotal = 0;
            $cartUserData = Cart::where('user_id', Auth::id());
            $cartData = $cartUserData->get();
            $setting = Setting::first();

            $bookingNumber = "HF" . self::generateOtp(6);
            $booking = Booking::create([
                'user_id' => Auth::id(),
                'booking_number' => $bookingNumber,
                'name' => Auth::user()->getFullNameAttribute(),
                'phone' => Session::get('phone'),
                'address' => Session::get('complete_address'),
                'vat' => "0.00",
                'shipping_charge' => $setting->shipping_charge,
                'status' => 'active',
            ]);
            Session::forget('phone', 'complete_address');

            if ($cartData) {
                foreach ($cartData as $data) {
                    $amount = (float)$data->getProduct->selling_offer_price * (int)$data->quantity;
                    $subTotal += $amount;

                    BookingDetail::create([
                        'booking_id' => $booking->id,
                        'product_id' => $data->product_id,
                        'variation_combination' => $data->variation_combination,
                        'quantity' => $data->quantity,
                        'amount' => $amount,
                    ]);

                    Product::find($data->product_id)->decrement('quantity', $data->quantity);
                }
            }
            $vat = ($setting->vat / 100) * $subTotal;
            $totalAmount = $subTotal + $vat + $setting->shipping_charge;
            $totalAmount = round($totalAmount, 2);

            $result = $this->stripePayment($payload, $totalAmount * 100, $bookingNumber);

            // $totalAmount = number_format($totalAmount, 2);
            // $result = $this->braintreePayment($nonce, $totalAmount, $bookingNumber);
            // if (!$result->success)
            //     return response()->json($result);
            // $transaction_id = $result->transaction->id;

            $transaction_id = $result['id'];

            Transaction::create([
                'transaction_id' => $transaction_id,
                'booking_id' => $booking->id,
                'amount' => $totalAmount,
                'type' => "Credited",
                'booking_for' => "Items",
                'transaction_date' => date('Y-m-d')
            ]);

            $booking->update([
                'subtotal_amount' => $subTotal,
                'vat' => $vat,
                'total_amount' => $totalAmount,
                'transaction_id' => $transaction_id,
                'status_date' => date('Y-m-d')
            ]);
            $cartUserData->delete();

            $this->sendMail($booking->id);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }

        // return response()->json($result);
        return redirect()->route('booking.success', ['item']);
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
     * @param mixed $bookingId
     * @return void
     */
    public function sendMail($bookingId)
    {
        $bookingDetails = Booking::with('getBookingDetail.getProductDetail')->find($bookingId);
        $bookingDetail                     =   [];
        $bookingDetail['mail_subject']     =   "Order Successful";
        $bookingDetail['email']            =   Auth::user()->email;
        $bookingDetail['booking_detail']   =   $bookingDetails;

        Mail::send(new BookingSuccessMail($bookingDetail));
    }

    /**
     * booking success page
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function bookingSuccess($booking_type)
    {
        return view('pages.frontend.booking_success', compact('booking_type'));
    }
}
