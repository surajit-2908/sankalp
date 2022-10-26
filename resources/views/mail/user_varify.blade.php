<!DOCTYPE html>
<html>

<head>
    <title>Mail</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
    <div style="max-width:640px; margin:0 auto;">
        <div style="/*width:620px;*/background:#F5F5F3; /*padding: 0px 10px;*/ border:1px solid #dcd7d7;">
            <div
                style="float: none; text-align: center; margin-top: 0px; background:url('{{ URL::to('public/images/menu-bg.png') }}') repeat center center">
                <img src="{{ URL::to('public/frontend/images/logo.png') }}" width="240" alt="" style="padding: 5px;">
            </div>
        </div>
        <div style="max-width:620px; border:1px solid #f0f0f0; margin:0 0; padding:15px; ">
            <h1 style="font-family:Arial; font-size:16px; font-weight:500; /*color:#8ccd56;*/ margin:5px 0 12px 0;">Dear
                {{ @$data['driverDetail']->name ? $data['driverDetail']->name : 'User' }},</h1>


            <div style="display:block; overflow:hidden; width:100%;">
                <p style="font-family:Arial; font-size:14px; font-weight:500; color:#000;margin: 15px 0px 15px;">
                    {{ $data['content'] }}
                </p>
            </div>
            <p style="font-family:Arial; font-size:14px; font-weight:500; color:#363839;margin: 0px 0px 10px 0px;">Thank
                you,</p>
            <p style="font-family:Arial; font-size:14px; font-weight:500; color:#363839;margin: 0px 0px 10px 0px;">Team
                Demo</p>
        </div>
    </div>
</body>

</html>
