@extends('layouts.layout')
@push('links')
    <link type="text/css" href="{{ asset('msg-alert-plugin/dist/css/bootstrap-msg.css') }}" rel="stylesheet">
@endpush
@section('content')

    <div class="afterLoginBodyPrt">
        <div class="container">
            @include('includes.frontend.message')
            <div class="afterLoginBodyRow">
                @include('includes.frontend.profile-sidebar')

                <div class="afterLoginRightPanel">
                    <div class="mngAdrsBdyPrt">
                        <h2>Manage Addresses</h2>
                        <a class="addNewAdrs" href="javascript:void(0)">+ Add a New address</a>
                        <div class="prfilInfoBdyPrt newAddressPrt" style="display: none;">
                            <form action="{{ route('user.insert.address') }}" method="post" class="prfilInfoForm" id="prfilInfoForm">
                                {{ csrf_field() }}
                                <p>ADD A NEW ADDRESS</p>
                                <div class="dFlex">
                                    <div class="twoClmFormField">
                                        <div class="formGroup">
                                            <input class="formControl" placeholder="Name" type="text" name="name"
                                                required />
                                        </div>
                                    </div>
                                    <div class="twoClmFormField">
                                        <div class="formGroup">
                                            <input class="formControl" placeholder="Mobile number" type="text"
                                                name="phone" required />
                                        </div>
                                    </div>
                                </div>

                                <div class="dFlex">
                                    <div class="twoClmFormField">
                                        <div class="formGroup">
                                            <select class="formControl" name="state" required>
                                                <option value="">--Select State--</option>
                                                @foreach (allState() as $key => $state)
                                                    <option value="{{ $key }}">{{ $state }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="twoClmFormField">
                                        <div class="formGroup">
                                            <input class="formControl" placeholder="City/District/Town" type="text"
                                                name="city" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="dFlex">
                                    <div class="twoClmFormField">
                                        <div class="formGroup">
                                            <input class="formControl" placeholder="Pincode" type="text" name="pincode"
                                                required />
                                        </div>
                                    </div>

                                    <div class="twoClmFormField">
                                        {{-- <div class="formGroup">
                                            <input class="formControl" placeholder="Locality" type="text" />
                                        </div> --}}
                                        <div class="formGroup">
                                            <input class="formControl" placeholder="Landmark (Optional)" type="text"
                                                name="landmark" />
                                        </div>
                                    </div>
                                </div>

                                <div class="dFlex">
                                    <div class="formGroup">
                                        <textarea class="formControl" placeholder="Address (Area and Street)" rows="4" name="address" required></textarea>
                                    </div>
                                </div>

                                <p class="mt10">Address Type</p>
                                <div class="twoClmFormField">
                                    <div class="formGroup">
                                        <div class="dFlexLeft">
                                            <div class="mgproRedio">
                                                <input type="radio" id="Home" name="type" value="Home"
                                                    checked="checked" />
                                                <label for="Home">Home</label>
                                            </div>
                                            <div class="mgproRedio">
                                                <input type="radio" id="Office" name="type" value="Office" />
                                                <label for="Office">Office</label>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                {{-- <div class="dFlex">
                                    <div class="twoClmFormField">
                                        <div class="formGroup">
                                            <input class="formControl" placeholder="Landmark (Optional)"
                                                type="text" />
                                        </div>
                                    </div>
                                    <div class="twoClmFormField">
                                        <div class="formGroup">
                                            <input class="formControl" placeholder="Alernate Phone (Optional)"
                                                type="text" />
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="dFlex">
                                    <div class="twoClmFormField">
                                        <button class="pinkBtn" type="submit">Save</button>
                                    </div>

                                    <div class="twoClmFormField">
                                        <a href="javascript:void(0)" class="cancelBtn">cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>


                        <div class="addressLine">
                            <ul>
                                @forelse ($userAddresses as $userAddress)
                                    <li id="remove_{{ $userAddress->id }}">
                                        <div class="addressArea">
                                            <h3>{{ $userAddress->type }}</h3>
                                            <h4>{{ $userAddress->name }}</h4>
                                            <p>{{ $userAddress->complete_address }}</p>
                                            @if ($userAddress->is_default)
                                                <h3 class="is-default">Default</h3>
                                            @endif
                                        </div>
                                        <div class="adrsModify">
                                            <i class="fa fa-ellipsis-h" aria-hidden="true"
                                                data-id="{{ $userAddress->id }}"></i>
                                            <ul class="adrsAction drpDwn_{{ $userAddress->id }}">
                                                <li><a href="javascript:void(0)"
                                                        onclick="editAddress('{!! $userAddress->id !!}');">Edit</a></li>
                                                @if (!$userAddress->is_default)
                                                    <li><a href="{{ route('user.address.default', $userAddress->id) }}">Set
                                                            as Default</a>
                                                    </li>
                                                @endif
                                                <li><a href="javascript:void(0)"
                                                        onclick="removeAddress('{!! $userAddress->id !!}');">Delete</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                    <div class="prfilInfoBdyPrt newAddressPrt" id="show_add_{{ $userAddress->id }}">
                                    </div>
                                @empty
                                    <li class="no-addr">No address added</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
    <script src="{{ asset('msg-alert-plugin/dist/js/bootstrap-msg.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $("#prfilInfoForm").validate({
            rules: {
                name: {
                    required: true
                },
                phone: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 11
                },
                city: {
                    required: true
                },
                pincode: {
                    required: true
                },
                address: {
                    required: true
                },
            },
            messages: {
                name: "Please enter your name",
                phone: {
                    required: "Please enter your mobile number",
                    number: "Please enter a valid mobile number",
                    minlength: "Please enter a valid mobile number",
                    maxlength: "Please enter a valid mobile number",
                },
                state: "Please select your state",
                city: "Please enter your city",
                pincode: "Please enter your pincode",
                address: "Please enter your address",
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.adrsModify .fa').click(function() {
                let id = $(this).data('id');
                $('.adrsAction').addClass("showD");
                $(`.drpDwn_${id}`).removeClass('showD');
                $('.showD').removeClass('openAction');
                $(`.drpDwn_${id}`).toggleClass("openAction");
                setTimeout(function() {
                    $(`.drpDwn_${id}`).removeClass("openAction");
                }, 5000);
            });
            $('.addNewAdrs').click(function() {
                $(this).toggle();
                $('.newAddressPrt').toggle();
                let count = {{ count($userAddresses) }};
                if (count < 1) {
                    $('.addressLine').hide();
                }
            });
            $('.cancelBtn').click(function() {
                let count = {{ count($userAddresses) }};
                $('.newAddressPrt').toggle();
                $('.addNewAdrs').toggle();
                if (count < 1) {
                    $('.addressLine').show();
                }
            });
        });


        function editAddress(add_id) {
            $(`.drpDwn_${add_id}`).removeClass("openAction");
            let url = "{{ route('admin.edit.address', ':slug') }}"
            url = url.replace(":slug", add_id);
            $.get(url, (data) => {
                $(".newAddressPrt").hide();
                $("#show_add_" + add_id).show();
                $("#show_add_" + add_id).append(data);
            });
        }

        function removeAddress(add_id) {
            swal({
                title: 'Are you sure?',
                text: 'This address will be deleted!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    $(`.drpDwn_${add_id}`).removeClass("openAction");
                    $.post('{{ route('user.address.remove') }}', {
                        "add_id": add_id,
                        "_token": "{!! @csrf_token() !!}"
                    }, function(response) {
                        if (response.status == "success") {
                            if (response.user_count == 0) {
                                $('.addressLine').hide();
                            }
                            $('#remove_' + add_id).hide();
                            Msg.success('Address deleted successfully', 3000);
                        } else if (response.status == "error") {
                            Msg.error('Unable To Process Your Request', 3000);
                        }
                    });
                }
            });
        }
    </script>
@endpush
