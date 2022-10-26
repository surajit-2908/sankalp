@extends('layouts.layout')
@section('content')

    <!-- Body part Start here -->
    <div class="loginBodySec">
        <div class="container">
            <div class="loginCol">
                @include('includes.frontend.message')
                <h2>Reset your password</h2>
                <p>Forgot your password? No worries, Just enter the email you
                    used to sign up and we'll send you a link to reset it.</p>
                <form class="mt40" action="{{ route('reset.password') }}" method="POST" id="myform">
                    @csrf
                    <div class="formGroup">
                        <label>Email</label>
                        <input class="formControl" name="email" placeholder="Enter Email" type="email" />
                    </div>
                    <div class="formGroup">
                        <input class="btn submitBtn" value="send password reset email" type="submit" />
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
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                email: "Please enter a valid email address",
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    </script>
@endpush
