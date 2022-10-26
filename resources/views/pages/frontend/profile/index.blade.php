@extends('layouts.layout')
@section('content')

    <div class="afterLoginBodyPrt">
        <div class="container">
            @include('includes.frontend.message')
            @include('includes.err-msg')
            <div class="afterLoginBodyRow">
                @include('includes.frontend.profile-sidebar')

                <div class="afterLoginRightPanel">
                    <div class="prfilInfoBdyPrt">
                        <form action="{{ route('user.profile.update') }}" method="post" class="prfilInfoForm" id="myform">
                            {{ csrf_field() }}
                            <p class="mt0">Personal Information</p>
                            <div class="dFlex">
                                <div class="twoClmFormField">
                                    <div class="formGroup">
                                        <input class="formControl" placeholder="First name" type="text" name="fname"
                                            value="{{ Auth::user()->fname }}" required />
                                    </div>
                                </div>
                                <div class="twoClmFormField">
                                    <div class="formGroup">
                                        <input class="formControl" placeholder="Last name" type="text" name="lname"
                                            value="{{ Auth::user()->lname }}" required />
                                    </div>
                                </div>
                            </div>

                            <p class="mt30">Your Gender</p>
                            <ul class="heroFitRadioBtn dFlex">
                                <li>
                                    <input type="radio" id="prfil_info_male" value="m" name="gender"
                                        {{ Auth::user()->gender == 'm' ? 'checked' : '' }} required>
                                    <label for="prfil_info_male">Male</label>
                                </li>
                                <li>
                                    <input type="radio" id="prfil_info_female" value="f" name="gender"
                                        {{ Auth::user()->gender == 'f' ? 'checked' : '' }}>
                                    <label for="prfil_info_female">Female</label>
                                </li>
                            </ul>

                            <p>Email Address<a href="javascript:void(0)" data-toggle="modal"
                                    data-target="#exampleModal">Change
                                    Password</a></p>
                            <div class="twoClmFormField">
                                <div class="formGroup">
                                    <input class="formControl" placeholder="Email address" type="text" name="email"
                                        value="{{ Auth::user()->email }}" disabled />
                                </div>
                            </div>

                            <p>Mobile Number</p>
                            <div class="twoClmFormField">
                                <div class="formGroup">
                                    <input class="formControl" placeholder="XX XXXXXXXXX" type="text" name="phone"
                                        value="{{ Auth::user()->phone }}" required />
                                </div>
                            </div>

                            <div class="twoClmFormField">
                                <button class="pinkBtn" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="prfilInfoBdyPrt">
                        <form action="{{ route('user.password.update') }}" method="post" class="prfilInfoForm changePass"
                            id="myform1">
                            {{ csrf_field() }}

                            <p>Current password</p>

                            <div class="formGroup">
                                <input class="formControl" placeholder="Enter current password" type="password"
                                    name="current_password" required />
                            </div>

                            <p>New password</p>

                            <div class="formGroup">
                                <input class="formControl" placeholder="Enter new password" type="password"
                                    name="new_password" id="password-field" required />
                            </div>

                            <p>Confirm password</p>

                            <div class="formGroup">
                                <input class="formControl" placeholder="Enter confirm password" type="password"
                                    name="confirm_password" required />
                            </div>

                            <button class="pinkBtn" type="submit">Save</button>

                        </form>
                    </div>
                    {{-- <div class="modal-footer">
                        <button type="submit" class="shopBtn">Save</button>
                    </div> --}}
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
                    phone: {
                        required: true,
                        number: true,
                        minlength: 10,
                        maxlength: 11
                    },
                    gender: {
                        required: true,
                    },
                },
                messages: {
                    fname: "Please enter first name",
                    lname: "Please enter last name",
                    phone: {
                        required: "Please enter your phone number",
                        number: "Please enter a valid phone number",
                        minlength: "Please enter a valid phone number",
                        maxlength: "Please enter a valid phone number",
                    },
                    gender: "Please select gender",
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
            $("#myform1").validate({
                rules: {
                    current_password: {
                        required: true,
                        minlength: 6
                    },
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
                    current_password: 'Please enter your current password at least 6 characters',
                    new_password: 'Please enter your new password at least 6 characters',
                    confirm_password: 'Enter Confirm Password Same as New Password'
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        </script>
    @endpush
