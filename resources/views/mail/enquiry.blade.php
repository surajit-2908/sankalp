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
                <img src="{{ asset('assets/images/logo.png') }}" width="240" alt="" style="padding: 5px;">
            </div>
        </div>
        <div style="max-width:620px; border:1px solid #f0f0f0; margin:0 0; padding:15px; ">
            <h1 style="font-family:Arial; font-size:16px; font-weight:500; margin:5px 0 12px 0;">Dear Admin,</h1>

            <div style="display:block;overflow:hidden; width:100%; margin: 5px 0px 10px 0px;">
                <p
                    style="font-family:Arial; font-size:14px; font-weight:500; text-align:center; color:#000;padding: 4px; background:#f5f5f5;">
                    A new enquiry has been received
                </p>
            </div>

            <div style="display:block;overflow:hidden; width:100%; margin: 5px 0px 10px 0px;">
                <p
                    style="font-family:Arial; font-size:14px; font-weight:500; text-align:left; color:#000;padding: 4px; margin:0px;">
                    Company Name : {{ @$enquiry['company_name'] }}
                </p>
                <p
                    style="font-family:Arial; font-size:14px; font-weight:500; text-align:left; color:#000;padding: 4px; margin:0px;">
                    Key Person : {{ @$enquiry['key_person'] }}
                </p>
                <p
                    style="font-family:Arial; font-size:14px; font-weight:500; text-align:left; color:#000;padding: 4px; margin:0px;">
                    Email : {{ @$enquiry['email'] }}
                </p>
                <p
                    style="font-family:Arial; font-size:14px; font-weight:500; text-align:left; color:#000;padding: 4px; margin:0px;">
                    Country : {{ @$enquiry['country'] }}
                </p>
                <p
                    style="font-family:Arial; font-size:14px; font-weight:500; text-align:left; color:#000;padding: 4px; margin:0px;">
                    Phone : {{ @$enquiry['phone'] }}
                </p>
                <p
                    style="font-family:Arial; font-size:14px; font-weight:500; text-align:left; color:#000;padding: 4px; margin:0px;">
                    Industry : {{ @$enquiry['industry'] }}
                </p>
                <p
                    style="font-family:Arial; font-size:14px; font-weight:500; text-align:left; color:#000;padding: 4px; margin:0px;">
                    Enquiry : {{ @$enquiry['enquiry'] }}
                </p>
            </div>

            <p style="font-family:Arial; font-size:14px; font-weight:500; color:#363839;margin: 0px 0px 0px 0px;">Thank
                you,<br>Team Sankalp</p>

        </div>
    </div>
</body>

</html>
