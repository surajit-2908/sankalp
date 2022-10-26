<!DOCTYPE html>
<html>

<head>
    <title>Contact Us</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div style="max-width:640px; margin:0 auto;">
        <div style="background:#F5F5F3; border:1px solid #dcd7d7;">
            <div
                style="float: none; text-align: center; margin-top: 0px; background:url('{{ URL::to('#') }}') repeat center center">
                <img src="{{ asset('assets/images/footer-logo.png') }}" width="240" alt="" style="padding: 5px;">
            </div>
        </div>
        <div style="max-width:620px; border:1px solid #f0f0f0; margin:0 0; padding:15px; ">
            <h1 style="font-family:Arial; font-size:16px; font-weight:500; margin:5px 0 12px 0;">Dear
                {{ @$booking['booking_detail']->name }},</h1>

            @if (@$booking['type'] == 'onine_training')
                <div style="display:block;overflow:hidden; width:100%; margin: 5px 0px 10px 0px;">
                    <p
                        style="font-family:Arial; font-size:14px; font-weight:500; text-align:center; color:#000;padding: 4px;">
                        Order number with <b>#{{ @$booking['booking_detail']->booking_number }}</b> has been cancelled
                        successfully. It may take 5-10 business days to process.
                    </p>
                </div>
            @else
                @if (@$booking['status'] == 'refunded')
                    <div style="display:block;overflow:hidden; width:100%; margin: 5px 0px 10px 0px;">
                        <p
                            style="font-family:Arial; font-size:14px; font-weight:500; text-align:center; color:#000;padding: 4px;">
                            Order number with <b>#{{ @$booking['booking_detail']->booking_number }}</b> has been
                            cancelled successfully. It may take 5-10 business days to process.
                        </p>
                    </div>

                    <table cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 0px;">
                        <thead>
                            <tr>
                                <th style="text-align: left;font-family:Arial;">
                                    Products
                                </th>
                                <th style="padding: 10px;font-weight: 500;font-size: 16px;font-family:Arial;">
                                    Quantity
                                </th>
                                <th style="padding: 10px;font-weight: 500;font-size: 16px;font-family:Arial;">
                                    Price
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($booking['booking_detail']->getBookingDetail as $key => $booking_detail)
                                @php
                                    $variationArr = json_decode($booking_detail->variation_combination);
                                @endphp
                                <tr>
                                    <td title="Products"
                                        style="padding: 15px 0px; {{ $key % 2 == 0 ? 'background: #f0fffe;' : 'background: #d4fcf9;' }}">
                                        <div class="imgdescribe" style="display: flex;align-items: center;">
                                            <div class="leftimgsec"
                                                style="width: 100px;height: 60px;margin-right: 20px;verflow: hidden;display: flex;">
                                                <img src="{{ asset('storage/product_image/' . @$booking_detail->getProductDetail->image) }}"
                                                    alt=""
                                                    style="width: 100%;height: 100%; padding: 5px 20px;" />
                                            </div>
                                            <div>
                                                <h3 style="font-size: 16px;font-family:Arial;margin: 0px;">
                                                    {{ @$booking_detail->getProductDetail->title }}</h3>
                                                @if ($variationArr)
                                                    @foreach (@$variationArr as $variation => $varOpt)
                                                        <p style="margin: 0px;"><b>{{ $variation }} -</b>
                                                            {{ $varOpt[0] }}</p>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td title="Quantity"
                                        style="text-align: center;padding: 15px 0px; font-family:Arial;{{ $key % 2 == 0 ? 'background: #f0fffe;' : 'background: #d4fcf9;' }}">
                                        {{ @$booking_detail->quantity }}
                                    </td>
                                    <td title="Price"
                                        style="text-align: center;padding: 15px 0px;font-family:Arial; {{ $key % 2 == 0 ? 'background: #f0fffe;' : 'background: #d4fcf9;' }}">
                                        ${{ number_format(@$booking_detail->amount, 2) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <table cellpadding="0" cellspacing="0" width="50%" align="right"
                        style="margin-bottom: 10px; margin-top: 10px; border-collapse: collapse; margin-left:50%;">

                        <tbody>
                            <tr>
                                <td title="Subtotal" style="padding: 3px 0px;">
                                    <p style="font-size: 16px;font-family:Arial; margin: 0px;">Subtotal</p>
                                </td>
                                <td title="Subtotal" style="padding: 3px 0px;text-align: right;">
                                    <p style="font-size: 16px;font-family:Arial; margin: 0px;">
                                        ${{ number_format(@$booking['booking_detail']->subtotal_amount, 2) }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td title="Vat" style="padding: 3px 0px;">
                                    <p style="font-size: 16px;font-family:Arial; margin: 0px;">Vat</p>
                                </td>
                                <td title="Vat" style="padding: 3px 0px;text-align: right;">
                                    <p style="font-size: 16px;font-family:Arial; margin: 0px;">
                                        ${{ number_format(@$booking['booking_detail']->vat, 2) }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td title="Shipping Charge" style="padding: 3px 0px;">
                                    <p style="font-size: 16px;font-family:Arial; margin: 0px;">Shipping Charge</p>
                                </td>
                                <td title="Shipping Charge" style="padding: 3px 0px;text-align: right;">
                                    <p style="font-size: 16px;font-family:Arial; margin: 0px;">
                                        ${{ number_format(@$booking['booking_detail']->shipping_charge, 2) }}</p>
                                </td>
                            </tr>
                            <tr style="border-bottom: 1px solid #000;">
                                <td title="Refund Charge" style="padding: 3px 0px;">
                                    <p style="font-size: 16px;font-family:Arial; margin: 0px;">Refund Charge</p>
                                </td>
                                <td title="Refund Charge" style="padding: 3px 0px;text-align: right;">
                                    <p style="font-size: 16px;font-family:Arial; margin: 0px;">
                                        ${{ number_format(@$booking['booking_detail']->refund_charge, 2) }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td title="Estimated Total" style="padding: 3px 0px;">
                                    <h3 style="font-size: 16px;font-family:Arial; margin: 0px;">Estimated Total Refund
                                    </h3>
                                </td>
                                <td title="Estimated Total" style="padding: 3px 0px;">
                                    <h3 style="font-size: 16px;font-family:Arial; margin: 0px;text-align: right;">
                                        ${{ number_format(@$booking['booking_detail']->total_amount - @$booking['booking_detail']->refund_charge, 2) }}
                                    </h3>
                                    {{-- <small style="display: block; color: #28a745;">Including vat and shipping charge</small> --}}
                                </td>
                            </tr>

                        </tbody>
                    </table>
                @else
                    <div style="display:block;overflow:hidden; width:100%; margin: 5px 0px 10px 0px;">
                        <p
                            style="font-family:Arial; font-size:14px; font-weight:500; text-align:center; color:#000;padding: 4px;">
                            Order number with <b>#{{ @$booking['booking_detail']->booking_number }}</b> is delivered
                            successfully.
                        </p>
                    </div>
                    <div
                        style="display:block;overflow:hidden; width:100%; text-align:center; margin: 0px 0px 10px 0px;">
                        <a href="{{ route('shop') }}"
                            style="font-family:Arial; border-radius:17px;font-size:15px; font-weight:500; color:#FFF; display:inline-block; padding: 7px 12px; background:#d50b3b; text-decoration:none;">Shop
                            more</a>
                    </div>
                @endif
            @endif

            <p style="font-family:Arial; font-size:14px; font-weight:500; color:#363839;margin: 0px 0px 0px 0px;">Thank
                you,<br>Team Hero Fit</p>

        </div>
    </div>
</body>

</html>
