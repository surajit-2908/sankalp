@extends('layouts.layout')
@section('content')

    <!-- Body part Start here -->
    <div class="loginBodySec">
        <div class="container">
            <div class="loginCol">
                @include('includes.frontend.message')
                @include('includes.err-msg')
                <h2>Create account</h2>
                <form class="mt40" action="{{ route('signup.user') }}" method="POST" id="myform">
                    @csrf
                    <div class="formGroup">
                        <label>First Name {{ old('fname') }}</label>
                        <input class="formControl" name="fname" placeholder="Enter First Name" type="text"
                            value="{{ old('fname') }}" required />
                    </div>
                    <div class="formGroup">
                        <label>Last Name</label>
                        <input class="formControl" name="lname" placeholder="Enter Last Name" type="text"
                            value="{{ old('lname') }}" required />
                    </div>
                    <div class="formGroup">
                        <label>Email</label>
                        <input class="formControl" name="email" id="email" placeholder="Enter Email" type="email"
                            value="{{ old('email') }}" required />
                        <label id="email_exist" class="error" style="display: none;">Email already exists</label>
                        <label id="mail_sending_msg" class="text-success" style="display: none;">Verify mail is
                            sending....</label>
                        <label id="mail_msg" class="text-success" style="display: none;">Mail successfully sent with
                            otp.</label>
                    </div>

                    <div class="formGroup" id="email_otp" @if (!Session::has('invalid_otp')) style="display: none;" @endif>
                        <label>OTP</label>
                        <input class="formControl" name="email_otp" placeholder="Enter Otp" type="text" required />
                    </div>
                    <div class="formGroup">
                        <label>Password</label>
                        <div class="relPo">
                            <input id="password-field" class="formControl" name="password"
                                placeholder="Enter Password" type="password" required />
                            <span toggle="#password-field" class="fa fa-lg fa-eye field-icon toggle-password"></span>
                        </div>
                    </div>
                    <div class="formGroup">
                        <input class="btn submitBtn" id="submitBtn" value="Create account" type="submit" />
                    </div>
                    <p>Already have an account? <a href="{{ route('user.login') }}">Login</a></p>
                </form>
            </div>
        </div>
    </div>
@stop

@push('scripts')
    <script>
        $("#myform").validate({
            rules: {
                fname: {
                    required: true
                },
                lname: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                email_otp: {
                    required: true
                },
                password: {
                    required: true,
                    minlength: 6
                }
            },
            messages: {
                fname: "Please enter your first name",
                lname: "Please enter your last name",
                email: "Please enter a valid email address",
                email_otp: "Please enter otp",
                password: {
                    required: "Please provide a password",
                    minlength: "Password must be at least 6 characters"
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            // $(".toggle-password").click(function() {
            //     $(this).toggleClass("fa-eye fa-eye-slash");
            //     var input = $($(this).attr("toggle"));
            //     if (input.attr("type") == "password") {
            //         input.attr("type", "text");
            //     } else {
            //         input.attr("type", "password");
            //     }
            // });

            $("#email").on('blur', () => {
                $('#submitBtn').attr('disabled', "disabled");
                $('#mail_msg').hide();
                $('#email_exist').hide();
                let email = $('#email').val();
                let result = email.match(
                    /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                );
                if (result != null) {
                    $('#mail_sending_msg').show();
                    let url = "{{ route('email.verify', ':slug') }}"
                    url = url.replace(":slug", email);
                    $.get(url, (response) => {
                        if (response.status == "success") {
                            $('#submitBtn').attr('disabled', false);
                            $('#mail_sending_msg').hide();
                            $('#mail_msg').show();
                            setTimeout(function() {
                                $('#mail_msg').fadeOut('slow');
                            }, 5000);
                            $('#email_otp').show();
                        } else if (response.email_exist) {
                            $('#submitBtn').attr('disabled', false);
                            $('#mail_sending_msg').hide();
                            $('#email_exist').show();
                            setTimeout(function() {
                                $('#email_exist').fadeOut('slow');
                            }, 5000);
                        }
                    });
                }
            });
        });
    </script>
@endpush
