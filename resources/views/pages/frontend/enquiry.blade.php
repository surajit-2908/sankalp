@extends('layouts.layout')
@section('content')
    <!--========================== Body Right Panel Start ==========================-->
    <div class="bodyRightPanel homeBody">
        <div class="breadcrumbSec">
            <ul class="dFlx alignCenter">
                <li><a href="javascript:void(0)">Support</a></li>
                <li>Contact Us</li>
            </ul>
        </div>
        @include('includes.frontend.message')

        <div class="homeTopHdnArea">
            <h1>We are always here to help !</h1>
        </div>

        <form action="{{ route('save.enquiry') }}" method="post" class="contactFormArea dFlx spaceBet SKPformField"
            id="myform">
            {{ csrf_field() }}
            <div class="contactFormLeftClm">
                <div class="FullWidthField">
                    <input type="text" name="company_name" placeholder="Company name*" required="required">
                </div>
                <div class="FullWidthField">
                    <input type="text" name="key_person" placeholder="Key person*" required="required">
                </div>
                <div class="FullWidthField">
                    <input type="email" name="email" placeholder="Email address*" required="required">
                </div>
                <div class="FullWidthField">
                    <input type="text" name="country" placeholder="Country*" required="required">
                </div>
                <div class="FullWidthField">
                    <input type="text" name="phone" placeholder="Telephone number*" required="required">
                </div>
                {{-- pattern="[789][0-9]{9}" --}}
                <div class="FullWidthField">
                    <input type="text" name="industry" placeholder="Industry*" required="required">
                </div>
            </div>

            <div class="contactFormRightClm">
                <div class="FullWidthField">
                    <textarea placeholder="Enquiry*" name="enquiry" required="required"></textarea>
                </div>
                <div class="captchaRow">
                    <ul class="dFlx spaceBet alignCenter">
                        <li class="captchaField"><input type="text" name="captcha" id="captcha"
                                placeholder="Enter captcha" required="required">

                            @if ($errors->has('captcha'))
                                <span class="help-block text-danger">
                                    <strong>{{ $errors->first('captcha') }}</strong>
                                </span>
                            @endif
                        </li>
                        {{-- <li class="captchaImg"><img src="{{ asset('assets/images/captcha-img.png') }}" alt=""></li>
                        <li class="captchaReloadIcon"><img src="{{ asset('assets/images/captcha-reload-icon.png') }}"
                                alt=""></li> --}}
                        <li class="captchaImg">{!! captcha_img('flat') !!}</li>
                        <li class="captchaReloadIcon" id="reload"><img
                                src="{{ asset('assets/images/captcha-reload-icon.png') }}" alt=""></li>
                    </ul>
                </div>
                <div class="FullWidthField">
                    <input type="submit" class="yellowBtn" name="" value="Submit">
                </div>
                <p class="termsService">By clicking submit, I acknowledge that I have rights to the information submitted
                    and accept Sankalp Corporation’s <a href="javascript:void(0)">Terms of Service.</a></p>
            </div>
        </form>

    </div>
    <!--========================== Body Right Panel Start ==========================-->
@stop

@push('scripts')
    <script>
        $("#myform").validate({
            rules: {
                company_name: {
                    required: true
                },
                key_person: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                country: {
                    required: true
                },
                phone: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 11
                },
                industry: {
                    required: true
                },
                enquiry: {
                    required: true
                },
                captcha: {
                    required: true
                },
            },
            messages: {
                company_name: "Please enter company name",
                key_person: "Please enter key person",
                email: "Please enter a valid email address",
                country: "Please enter country name",
                phone: "Please enter a valid telephone number",
                industry: "Please enter industry name",
                enquiry: "Please type your enquiry",
                captcha: "Please fill captcha",
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    </script>
    <script type="text/javascript">
        $('#reload').click(function() {
            $.ajax({
                type: 'GET',
                url: 'reload-captcha',
                success: function(data) {
                    $(".captchaImg").html(data.captcha);
                }
            });
        });
    </script>
@endpush
