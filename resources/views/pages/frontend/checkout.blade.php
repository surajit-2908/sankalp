@extends('layouts.layout')
@push('links')
    <link type="text/css" href="{{ asset('msg-alert-plugin/dist/css/bootstrap-msg.css') }}" rel="stylesheet">
@endpush
@section('content')

    <div class="bodyBG">
        <div class="shopPagemain">
            <div class="container">
                <div class="breadcamp">
                    Home > Shop > Cart > Information > Shipping > Checkout
                </div>


                <div class="paymentSec">
                    <div class="paymentLeftCol">
                        <div class="payTopSec">
                            <form method="post" action="{{ route('payment') }}" id="bookingForm">
                                {{ csrf_field() }}
                                <div class="paytopRow">
                                    <div class="contactSec">Contact</div>
                                    <div class="fSec">
                                        <p class="contact_phone" id="show_contact_nm">
                                            {{ @Auth::user()->getDefaultAddress->phone }}</p>
                                        <input class="form-control" type="hidden" name="phone" id="phone"
                                            value="{{ @Auth::user()->getDefaultAddress->phone }}" />
                                        <a href="javascript:void(0)" id="contact_phone_cancel" style="display: none;"><i
                                                class="fa fa-times"></i></a>
                                        <a href="javascript:void(0)" id="contact_phone_save" style="display: none;"><i
                                                class="fa fa-check"></i></a>

                                    </div>
                                    <a href="javascript:void(0)" id="contact_phone">Change</a>


                                </div>
                                <div class="borderBt"></div>
                                <div class="paytopRow">
                                    <div class="contactSec">Ship to</div>
                                    <p class="contact_address">{{ @Auth::user()->getDefaultAddress->complete_address }}
                                    </p>
                                    <input type="hidden" name="complete_address" id="complete_address"
                                        value="{{ @Auth::user()->getDefaultAddress->complete_address }}" />
                                    <input type="hidden" name="address_id" id="address_id"
                                        value="{{ @Auth::user()->getDefaultAddress->id }}" />
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal">Change</a>
                                </div>
                            </form>
                        </div>
                        <div class="titleBorder">
                            <h2>Shipping method</h2>
                        </div>
                        <div class="payTopSec">
                            <div class="paytopRow flxspBt">
                                <p class="stdIcon">Standard shipping (3-5 Days)</p>
                                <a
                                    href="javascript:void(0)"><strong>{{ $setting->shipping_charge ? "$" . number_format($setting->shipping_charge, 2) : 'Free' }}</strong></a>
                                {{-- <a href="javascript:void(0)"><strong>$17.50</strong></a> --}}
                            </div>
                        </div>
                        <div class="dFlexpay">
                            {{-- <a href="javascript:void(0)" class="shopBtn confirm-booking">Confirm Booking</a> --}}
                            <a href="javascript:void(0)" class="shopBtn confirm-booking">Continue to payment</a>
                            <p><a href="{{ route('user.cart') }}">Return to information</a></p>
                        </div>
                    </div>

                    <div class="payColRightmin">
                        <p><strong>Order summary</strong></p>
                        <div class="payColRight">
                            <div class="payitemList">
                                @foreach ($user_cart as $user_cart)
                                    @php
                                        $product_price = $user_cart->getProduct->selling_offer_price * $user_cart->quantity;
                                        $sub_total += $product_price;
                                        $variationArr = json_decode($user_cart->variation_combination);
                                        $user_pro_qnt = userCartPro(Auth::id(), $user_cart->getProduct->id, $user_cart->id);
                                        $qnt = $user_cart->getProduct->quantity - $user_pro_qnt;
                                    @endphp
                                    <div class="itemListmain" id="remove_item_{{ $user_cart->id }}">
                                        <a href="{{ route('product.detail', $user_cart->getProduct->slug) }}">
                                            <div class="itemImg">
                                                <img
                                                    src="{{ asset('storage/product_image') . '/' . $user_cart->getProduct->image }}" />
                                            </div>
                                        </a>
                                        <div class="itemCont">
                                            <h3>{{ $user_cart->getProduct->title }}</h3>
                                            <p class="price" id="pro_price_{{ $user_cart->id }}">
                                                ${{ number_format($product_price, 2) }}</p>
                                            <div class="dFlex">
                                                @if ($variationArr)
                                                    @foreach (@$variationArr as $variation => $varOpt)
                                                        <p><span>{{ $variation }} -</span> {{ $varOpt[0] }}</p>
                                                    @endforeach
                                                @endif
                                                <div class="dFlex">
                                                    <p><span>Quantity -</span></p>
                                                    <select onchange="changeQuantity('{!! $user_cart->id !!}', this)"
                                                        class="quanSelect" id="qunatityUpd_{{ $user_cart->id }}">
                                                        @if ($user_cart->getProduct->quantity < $user_cart->quantity)
                                                            @for ($i = 1; $i <= $user_cart->getProduct->quantity; $i++)
                                                                <option value="{{ $i }}"
                                                                    {{ $user_cart->getProduct->quantity == $i ? 'selected' : '' }}>
                                                                    {{ $i }}</option>
                                                            @endfor
                                                        @else
                                                            @for ($i = 1; $i <= $qnt; $i++)
                                                                <option value="{{ $i }}"
                                                                    {{ $user_cart->quantity == $i ? 'selected' : '' }}>
                                                                    {{ $i }}</option>
                                                            @endfor
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="product_price_{{ $user_cart->id }}"
                                        id="product_price_{{ $user_cart->id }}" value="{{ $product_price }}">
                                @endforeach
                                <input type="hidden" name="sub_total" id="sub_total" value="{{ $sub_total }}">


                            </div>
                            {{-- <div class="couponSec">
                                <input class="formcontrol" placeholder="Discount code" type="text" />
                                <input disabled type="button" value="Apply" />
                            </div> --}}
                            <div class="priceSec">
                                <div class="dFlex">
                                    <p>Subtotal</p>
                                    <p class="sub_total_amount">${{ number_format($sub_total, 2) }}</p>
                                </div>
                                <div class="dFlex">
                                    <p>Vat ({{ $setting->vat }}%)</p>
                                    <p class="vat_amount">${{ number_format(($setting->vat / 100) * $sub_total, 2) }}</p>
                                </div>
                                <div class="dFlex">
                                    <p>Shipping</p>
                                    <p>{{ $setting->shipping_charge ? "$" . number_format($setting->shipping_charge, 2) : 'Free' }}
                                    </p>
                                </div>
                                <div class="dFlex pTotalSec">
                                    <p>Total</p>
                                    <p class="sub_total_amount" id="total_amount">
                                        ${{ number_format($sub_total + ($setting->vat / 100) * $sub_total + $setting->shipping_charge, 2) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>

            </div>
        </div>
    </div>
    <div id="preloader" style="background-image: url({{ asset('assets/images/preloader.gif') }}); display: none;">
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Your Addresses</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @forelse ($userAddresses as $userAddress)
                        <div class="add-modal-div" data-id="{{ $userAddress->id }}"
                            data-phone="{{ $userAddress->phone }}"> <a href="javascript:void(0)">
                                {{ $userAddress->complete_address }}
                            </a>
                        </div>
                    @empty
                        <div class="no-add-modal-div">
                            <p>No address added... <a href="javascript:void(0)">Add address</a></p>
                        </div>
                    @endforelse
                </div>
                {{-- <div class="modal-footer">
                <button type="button" class="shopBtn">Save changes</button>
            </div> --}}
            </div>
        </div>
    </div>
@stop
@push('scripts')
    <script src="{{ asset('msg-alert-plugin/dist/js/bootstrap-msg.js') }}"></script>
    <script>
        function formValidate() {
            $("#bookingForm").validate({
                rules: {
                    phone: {
                        required: true,
                        number: true,
                        minlength: 10,
                        maxlength: 11
                    },
                },
                messages: {
                    phone: {
                        required: "Please enter your mobile number",
                        number: "Please enter a valid mobile number",
                        minlength: "Please enter a valid mobile number",
                        maxlength: "Please enter a valid mobile number",
                    }
                }
            });
            if ($('#bookingForm').valid()) {
                return true;
            } else {
                return false;
            }
        }

        function changeQuantity(cart_id) {
            const quantity = $("#qunatityUpd_" + cart_id).val();
            $("#preloader").show();
            $.post('{{ route('change.quantity.checkOut') }}', {
                "cart_id": cart_id,
                "quantity": quantity,
                "sub_total": $("#sub_total").val(),
                "_token": "{!! @csrf_token() !!}"
            }, function(response) {
                $("#preloader").hide();
                $(".payColRight").html(response);
                Msg.success('quantity changed successfully', 3000);
                // if (response.status == "success") {
                //     $("#preloader").hide();
                //     $('#pro_price_' + cart_id).text(response.product_price_string);
                //     $('.sub_total_amount').text(response.sub_total_string);
                //     $("#sub_total").val(response.sub_total)
                //     $('#total_amount').text(response.total_string);
                //     $("#product_price").val(response.product_price);
                //     $(".vat_amount").text(response.vat_string);
                //     Msg.success('quantity changed successfully', 3000);
                // } else if (response.status == "error") {
                //     Msg.error('Unable To Process Your Request', 3000);
                // }
            });
        }

        $(document).ready(function() {
            $("#contact_phone").click(function() {
                $(".contact_phone").toggle();
                $("#contact_phone_cancel").show();
                $("#contact_phone_save").show();
                $("#phone").get(0).type = 'text';
                $("#phone").focus();
                $(this).hide();
            });
            $("#contact_phone_save").click(function() {
                if (formValidate()) {
                    let address_id = $('#address_id').val();
                    let url = "{{ route('user.update.mobile', ':address_id') }}"
                    url = url.replace(":address_id", address_id);

                    $.post(url, {
                        "phone": $("#phone").val(),
                        "_token": "{!! @csrf_token() !!}"
                    }, function(response) {
                        $("#show_contact_nm").text($("#phone").val());
                        $(".contact_phone").toggle();
                        $("#contact_phone").show();
                        $("#phone").get(0).type = 'hidden';
                        $("#contact_phone_cancel").hide();
                        $("#contact_phone_save").hide();
                    });
                }
            });
            $("#contact_phone_cancel").click(function() {
                $("#phone").val($("#show_contact_nm").text().trim());
                $(".contact_phone").toggle();
                $("#contact_phone").show();
                $("#phone").get(0).type = 'hidden';
                $("#phone").removeClass('error');
                $("#contact_phone_cancel").hide();
                $("#phone-error").hide();
                $("#contact_phone_save").hide();
            });
            $(".add-modal-div").click(function() {
                let address = $(this).text().trim();

                $("#show_contact_nm").text($(this).data('phone'));
                $("#phone").val($(this).data('phone'));
                $('.contact_address').text(address);
                $('#complete_address').val(address);
                $('#address_id').val($(this).data('id'));
                $('#exampleModal').modal('toggle');
            });
            $(".confirm-booking").click(function() {
                if (formValidate())
                    $('#bookingForm').submit();
            });
        });
    </script>
@endpush
