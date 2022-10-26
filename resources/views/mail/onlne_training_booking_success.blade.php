<!DOCTYPE html>
<html>

<head>
    <title>Booking Successful</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div style="max-width:640px; margin:0 auto;">
        <div style="background:#F5F5F3; border:1px solid #dcd7d7;">
            <div
                style="float: none; text-align: center; margin-top: 0px; background:url('{{ URL::to('#') }}') repeat center center">
                <img src="{{ asset('assets/images/footer-logo.png') }}" width="240" alt=""
                    style="padding: 5px;">
            </div>
        </div>
        <div style="max-width:620px; border:1px solid #f0f0f0; margin:0 0; padding:15px; ">

            @if ($booking['email'] == env('ADMIN_EMAIL'))
                <h1 style="font-family:Arial; font-size:16px; font-weight:500; margin:5px 0 12px 0;">Dear Admin,</h1>

                <div style="display:block;overflow:hidden; width:100%; margin: 5px 0px 0px 0px;">
                    <p style="font-family:Arial; font-size:14px; font-weight:500; text-align:center;">
                        There is a new online training booking.
                    </p>
                </div>
                <p style="font-size: 16px;font-family:Arial;width:100%;text-align:center;margin-top:0px;">Order No.
                    {{ @$booking['booking_detail']->booking_number }}</p>
                <div style="display:block;overflow:hidden; width:100%; text-align:center; margin: 0px 0px 10px 0px;">
                    <a href="{{ route('admin.online.training.order.view', @$booking['booking_detail']->id) }}"
                        style="font-family:Arial; border-radius:17px;font-size:15px; font-weight:500; color:#FFF; display:inline-block; padding: 7px 12px; background:#ff0404; text-decoration:none;margin-bottom:5px;">Order
                        Details</a>
                </div>
            @else
                <h1 style="font-family:Arial; font-size:16px; font-weight:500; margin:5px 0 12px 0;">Dear
                    {{ @$booking['booking_detail']->name }},</h1>

                <div style="display:block;overflow:hidden; width:100%; margin: 5px 0px 0px 0px;">
                    <p style="font-family:Arial; font-size:14px; font-weight:500; text-align:center;">
                        We’re happy to let you know that we’ve received your order. We'll contact you soon.
                    </p>
                </div>
                <p style="font-size: 16px;font-family:Arial;width:100%;text-align:center;">Order No.
                    {{ @$booking['booking_detail']->booking_number }}</p>
            @endif
            <table cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 0px;">
                <thead>
                    <tr>
                        <th style="font-family:Arial;">
                            Item
                        </th>
                        <th style="padding: 10px;font-weight: 500;font-size: 16px;font-family:Arial;">
                            Hours
                        </th>
                        <th style="padding: 10px;font-weight: 500;font-size: 16px;font-family:Arial;">
                            Price
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td title="Products" style="padding: 15px 0px;">
                            <div class="imgdescribe" style="display: flex;align-items: center;">
                                <div class="leftimgsec"
                                    style="width: 100px;height: 60px;margin-right: 20px;verflow: hidden;display: flex;">
                                    <img src="{{ asset('storage/online_training_file/' . @$booking['training_data']->image) }}"
                                        alt="" style="width: 100%;height: 100%; padding: 5px 20px;" />
                                </div>
                                <div>
                                    <h3 style="font-size: 16px;font-family:Arial;margin: 0px;">
                                        {{ @$booking['training_data']->title }}</h3>
                                </div>
                            </div>
                        </td>
                        <td title="Hours" style="text-align: center;padding: 15px 0px; font-family:Arial">
                            {{ @$booking['training_data']->hours }} hours
                        </td>
                        <td title="Price" style="text-align: center;padding: 15px 0px;font-family:Arial;">
                            ${{ number_format(@$booking['training_data']->selling_price, 2) }}
                        </td>
                    </tr>
                </tbody>
            </table>

            <table cellpadding="0" cellspacing="0" width="50%" align="right"
                style="margin-bottom: 10px; margin-top: 10px; border-collapse: collapse; margin-left:50%;">

                <tbody>
                    <tr>
                        <td title="Price" style="padding: 3px 0px;">
                            <p style="font-size: 16px;font-family:Arial; margin: 0px;">Price</p>
                        </td>
                        <td title="Price" style="padding: 3px 0px;text-align: right;">
                            <p style="font-size: 16px;font-family:Arial; margin: 0px;">
                                ${{ number_format(@$booking['training_data']->price, 2) }}</p>
                        </td>
                    </tr>
                    <tr style="border-bottom: 1px solid #000;">
                        <td title="Discount" style="padding: 3px 0px;">
                            <p style="font-size: 16px;font-family:Arial; margin: 0px;">Discount</p>
                        </td>
                        <td title="Discount" style="padding: 3px 0px;text-align: right;">
                            <p style="font-size: 16px;font-family:Arial; margin: 0px;">
                                - ${{ number_format(@$booking['training_data']->price - @$booking['training_data']->selling_price, 2) }}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td title="Estimated Total" style="padding: 3px 0px;">
                            <h3 style="font-size: 16px;font-family:Arial; margin: 0px;">Estimated Total</h3>
                        </td>
                        <td title="Estimated Total" style="padding: 3px 0px;">
                            <h3 style="font-size: 16px;font-family:Arial; margin: 0px;text-align: right;">
                                ${{ number_format(@$booking['training_data']->selling_price, 2) }}</h3>
                        </td>
                    </tr>

                </tbody>
            </table>

            <p
                style="font-family:Arial; font-size:14px; font-weight:500; color:#363839;margin: 0px 0px 0px 0px; font-style: italic;">
                Thank you,<br>Team Hero Fit</p>

        </div>
    </div>
</body>

</html>
