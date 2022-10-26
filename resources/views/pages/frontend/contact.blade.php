@extends('layouts.banner_layout')
@section('content')

    <div class="bodyBG">
        @push('header')
            <!-- Banner Start here -->
            <div class="bannerMain">
                <div class="bannerbg">
                    <div class="bannerImg">
                        @if ($banner['top']->image)
                            <img alt="Hero Fit" title="Hero Fit"
                                src="{{ asset('storage/content_image') . '/' . $banner['top']->image }}" />
                        @else
                            <img alt="Hero Fit" title="Hero Fit" src="{{ asset('assets/images/contact-banner.png') }}" />
                        @endif
                    </div>
                    @include('includes.frontend.menu')
                    <div class="bannerText contactBanner">
                        <div class="container">
                            <h1>{{ $banner['top']->title }}</h1>
                            <p class="mbdBlock">{!! $banner['top']->description !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endpush

        <div class="getinTouchSec">
            <div class="container">
                <h2 class="titleText">Get in touch</h2>
                @include('includes.frontend.message')
                @include('includes.err-msg')
                <div class="dFlex">
                    <div class="contactFormCol">
                        <form action="{{ route('save.contact') }}" method="post" id="myform">
                            @csrf
                            <div class="dFlex">
                                <div class="formGroup">
                                    <label>First name</label>
                                    <input class="formControl" placeholder="" name="fname" type="text" required>
                                </div>
                                <div class="formGroup">
                                    <label>Last name</label>
                                    <input class="formControl" placeholder="" name="lname" type="text" required>
                                </div>
                            </div>
                            <div class="dFlex mt20">
                                <div class="formGroup">
                                    <label>Email address</label>
                                    <input class="formControl" placeholder="" name="email" type="text" required>
                                </div>
                                <div class="formGroup">
                                    <label>Contact number</label>
                                    <input class="formControl" placeholder="" name="phone" type="text" required>
                                </div>
                            </div>
                            <div class="dFlex mt40">
                                <textarea placeholder="Type your message" class="textArea" name="msg" required></textarea>
                            </div>
                            <div class="dFlex mt40">
                                <input class="shopBtn" value="Send message" type="submit">
                            </div>
                        </form>
                    </div>
                    <div class="contactAddressCol">
                        <h3>Don't hesitate to contact
                            us for any information.</h3>

                        <p class="evlopeIcon">Email <span>{{ $setting->contact_email }}</span></p>
                        <p class="phoneIcon">Phone <span>{{ $setting->contact_phone }}</span></p>
                        <p class="mapIcon">Address <span>{{ $setting->contact_address }}</span></p>

                    </div>
                </div>

            </div>
        </div>
    </div>
@stop

@push('scripts')
    <script>
        $("#myform").validate({
            rules: {
                fname: {
                    required: true,
                },
                lname: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true
                },
                phone: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 11
                },
                msg: {
                    required: true,
                },
            },
            messages: {
                fname: "Please enter first name",
                lname: "Please enter last name",
                email: "Please enter a valid email address",
                phone: {
                    required: "Please enter your phone number",
                    number: "Please enter a valid phone number",
                    minlength: "Please enter a valid phone number",
                    maxlength: "Please enter a valid phone number",
                },
                msg: "Please enter description",
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    </script>
@endpush
