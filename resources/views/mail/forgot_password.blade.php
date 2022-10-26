<!DOCTYPE html>
        <html>
            <head>
                <title>Mail</title>
                <meta name="viewport" content="width=device-width, initial-scale=1.0">

            </head>
            <body>
                <div style="max-width:640px; margin:0 auto;">
                    <div style="/*width:620px;*/background:#F5F5F3; /*padding: 0px 10px;*/ border:1px solid #dcd7d7;">
                        <div style="float: none; text-align: center; margin-top: 0px; background:url('{{ asset('assets/images/menu-bg.png') }}') repeat center center">
                             <img src="{{ asset('assets/images/footer-logo.png') }}" width="240" alt="" style="padding: 5px;">
                        </div>
                    </div>
                    <div style="max-width:620px; border:1px solid #f0f0f0; margin:0 0; padding:15px; ">
                        <h1 style="font-family:Arial; font-size:16px; font-weight:500; /*color:#8ccd56;*/ margin:5px 0 12px 0;">Dear {{@$user['user_detail']->getFullNameAttribute() }},</h1>


                        <div style="display:block; overflow:hidden; width:100%;">
                            <p style="font-family:Arial; font-size:14px; font-weight:500; color:#000;margin: 15px 0px 15px;">
                                Your forgot password link is given below to reset your password.
                            </p>
                        </div>
                        <div style="display:block;overflow:hidden; width:100%; margin: 5px 0px 10px 0px;">
                            <p style="font-family:Arial; font-size:14px; font-weight:500; text-align:center; color:#000;padding: 4px; background:#f5f5f5;">
                                Please click the link below :
                            </p>
                        </div>
                        <div style="display:block;overflow:hidden; width:100%; text-align:center; margin: 0px 0px 10px 0px;">
                                <a href="{{ route('reset.new.password',$user['otp']) }}" style="font-family:Arial; border-radius:17px;font-size:15px; font-weight:500; color:#FFF; display:inline-block; padding: 7px 12px; background:#d50b3b; text-decoration:none;">Click here</a>
                        </div>
                        <p style="font-family:Arial; font-size:14px; font-weight:500; color:#363839;margin: 0px 0px 10px 0px;">Thank you,</p>
                        <p style="font-family:Arial; font-size:14px; font-weight:500; color:#363839;margin: 0px 0px 10px 0px;">Team Hero Fit</p>
                    </div>
                </div>
            </body>
        </html>
