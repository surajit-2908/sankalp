@extends('layouts.layout')
@section('content')

    <!-- Body part Start here -->
    <div class="loginBodySec">
        <div class="container">
            <div class="loginCol">
                @include('includes.frontend.message')
                <h2>Login</h2>
                <p>Welcome back! Please enter your details below.</p>
                <form class="mt40" action="{{ route('login.user') }}" method="POST" id="myform">
                    @csrf
                    <div class="formGroup">
                        <label>Email</label>
                        <input class="formControl" name="email" placeholder="Enter Email" type="email" required />
                    </div>
                    <div class="formGroup">
                        <label>Password</label>
                        <div class="relPo">
                            <input id="password-field" class="formControl" name="password"
                                placeholder="Enter Password" type="password" required />
                            <span toggle="#password-field" class="fa fa-lg fa-eye field-icon toggle-password"></span>
                        </div>
                    </div>
                    <p class="text-right"><a href="{{ route('forgot.password') }}">Forgot password?</a></p>
                    <div class="formGroup">
                        <input class="btn submitBtn" value="Sign in" type="submit" />
                    </div>
                    <p>Dont have an account? <a href="{{ route('signup') }}">Sign up for free.</a></p>
                </form>
            </div>
        </div>
    </div>
@stop

@push('scripts')
    <script>
        $("#myform").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 6
                }
            },
            messages: {
                email: "Please enter a valid email address",
                password: {
                    required: "Please provide a password",
                    minlength: "Password must be at least 6 characters"
                },
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    </script>
@endpush
