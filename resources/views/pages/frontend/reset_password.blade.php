@extends('layouts.layout')
@section('content')

    <!-- Body part Start here -->
    <div class="loginBodySec">
        <div class="container">
            <div class="loginCol">
                @include('includes.frontend.message')
                <h2>Reset your password</h2>
                <p>Change your password for email <b>{{ $user->email }}</b></p>
                <form class="mt40" action="{{ route('update.forgot.password') }}" method="POST" id="myform">
                    @csrf
                    <input type="hidden" name="otp" value="{{ $otp }}">
                    <div class="formGroup">
                        <label>New Password</label>
                        <input class="formControl" name="new_password" placeholder="Enter New Password" type="password"
                            id="password-field" />
                    </div>
                    @error('new_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="formGroup">
                        <label>Confirm Password</label>
                        <input class="formControl" name="confirm_password" placeholder="Enter Confirm Password"
                            type="Password" />
                    </div>
                    @error('confirm_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="formGroup">
                        <input class="btn submitBtn" value="Submit" type="submit" />
                    </div>
                    <p>Remember password? <a href="{{ route('user.login') }}">Login</a></p>
                </form>
            </div>
        </div>
    </div>
@stop

@push('scripts')
    <script>
        $("#myform").validate({
            rules: {
                new_password: {
                    required: true,
                    minlength: 6
                },
                confirm_password: {
                    minlength: 6,
                    equalTo: "#password-field"
                }
            },
            messages: {
                new_password: 'Please enter your new password',
                confirm_password: 'Enter Confirm Password Same as Password'
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    </script>
@endpush
