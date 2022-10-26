@php
$notAvail = 0;
@endphp

@extends('layouts.layout')
@push('links')
    <link type="text/css" href="{{ asset('msg-alert-plugin/dist/css/bootstrap-msg.css') }}" rel="stylesheet">
@endpush
@section('content')

    <!-- Banner Start here -->
    <div class="bodyBG">
        <div class="shopPagemain">
            <div class="container">
                <div class="breadcamp">Home > Shop > Cart</div>
                <h2 class="titleText">Shopping cart</h2>

                <div id="cartMain">
                    <div class="cartMain" @if (!count($user_carts)) style="display: none;" @endif>
                        <div class="cartCol">
                            @foreach ($user_carts as $user_cart)
                                @php
                                    $product_price = $user_cart->getProduct->selling_offer_price * $user_cart->quantity;
                                    $sub_total += $product_price;
                                    $variationArr = json_decode($user_cart->variation_combination);
                                    $user_pro_qnt = userCartPro(Auth::id(), $user_cart->getProduct->id, $user_cart->id);
                                    $qnt = $user_cart->getProduct->quantity - $user_pro_qnt;
                                @endphp

                                <div class="itemListmain {{ !$user_cart->getProduct->quantity ? 'disableSec' : '' }}"
                                    id="remove_item_{{ $user_cart->id }}">
                                    <div class="itemClose" onclick="removeItem('{!! $user_cart->id !!}')">
                                        <img src="{{ asset('assets/images/close-icon.png') }}" />
                                    </div>
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
                                                    @if (!$user_cart->getProduct->quantity)
                                                        @php
                                                            $notAvail++;
                                                        @endphp
                                                        <option value="0">0</option>
                                                    @elseif($user_cart->getProduct->quantity < $user_cart->quantity)
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
                        <div class="cartColRight">
                            <div class="priceSec">
                                <div class="dFlex">
                                    <p>Subtotal
                                        ({{ count($user_carts) > 1 ? count($user_carts) . ' items' : count($user_carts) . ' item' }})
                                    </p>
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

                                <a href="javascript:void(0)" class="shopBtn notAvail disableBtn"
                                    @if (!$notAvail) style="display: none;" @endif>Can not Proceed to
                                    checkout</a>
                                <a href="{{ route('check.out') }}" class="shopBtn avail"
                                    @if ($notAvail) style="display: none;" @endif>Proceed to checkout</a>

                                <p><strong>We accept :</strong></p>
                                <img src="{{ asset('assets/images/card-img.png') }}" />
                                {{-- <p>
                                <small>Got a discount code? Add it in next step.</small>
                            </p> --}}
                            </div>
                        </div>
                    </div>
                    <div class="cartMain" id="cart-empty" @if (count(@$user_carts)) style="display: none;" @endif>
                        <div class="cart-empty">
                            <img src="{{ asset('assets/images/empty-cart.png') }}" />
                            <h4>Your Cart is Empty</h4>
                            {{-- <p>Add something to make me happy :)</p> --}}
                            <p>Looks like you have no items in your shopping cart.</p>

                            <a class="shopBtn" href="{{ route('shop') }}">Continue Shopping</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div id="preloader" style="background-image: url({{ asset('assets/images/preloader.gif') }}); display: none;">
    </div>
@stop
@push('scripts')
    <script src="{{ asset('msg-alert-plugin/dist/js/bootstrap-msg.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        function removeItem(cart_id) {
            swal({
                title: 'Are you sure?',
                text: 'This item will be removed from your cart!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value == true) {
                    $("#preloader").show();
                    $.post('{{ route('remove.cart.item') }}', {
                        "cart_id": cart_id,
                        "product_price": $("#product_price_" + cart_id).val(),
                        "sub_total": $("#sub_total").val(),
                        "not_avail": "{!! $notAvail !!}",
                        "_token": "{!! @csrf_token() !!}"
                    }, function(response) {
                        $("#preloader").hide();
                        let cart_count = $('.count').text() - 1;

                        if (cart_count == 0) {
                            $('.count').hide();
                        } else {
                            $('.count').text(cart_count);
                        }
                        $("#cartMain").html(response);
                        Msg.success('Item removed from cart', 3000);
                        // if (response.status == "success") {
                        //     $("#preloader").hide();
                        //     $('#remove_item_' + cart_id).hide();
                        //     $('.sub_total_amount').text(response.sub_total_string);
                        //     $('#total_amount').text(response.total_string);
                        //     $("#sub_total").val(response.sub_total);
                        //     $(".vat_amount").text(response.vat_string);
                        //     if (response.not_avail < 1) {
                        //         $('.notAvail').hide();
                        //         $('.avail').show();
                        //     }
                        //     if (response.cart_count == 0) {
                        //         $('.cartMain').fadeOut('slow');
                        //         $('#cart-empty').fadeIn('slow');
                        //         $('.count').hide();
                        //     } else {
                        //         $('.count').text(response.cart_count);
                        //     }
                        //     Msg.success('Item removed from cart', 3000);
                        // } else if (response.status == "error") {
                        //     Msg.error('Unable To Process Your Request', 3000);
                        // }
                    });
                }
            });
        }

        function changeQuantity(cart_id) {
            const quantity = $("#qunatityUpd_" + cart_id).val();
            $("#preloader").show();
            $.post('{{ route('change.quantity') }}', {
                "cart_id": cart_id,
                "quantity": quantity,
                "sub_total": $("#sub_total").val(),
                "_token": "{!! @csrf_token() !!}"
            }, function(response) {
                $("#preloader").hide();
                $("#cartMain").html(response);
                Msg.success('quantity changed successfully', 3000);
                // if (response.status == "success") {
                //     $("#preloader").hide();
                //     $("#cartMain").append(response);
                //     $('#pro_price_' + cart_id).text(response.product_price_string);
                //     $('.sub_total_amount').text(response.sub_total_string);
                //     $("#sub_total").val(response.sub_total)
                //     $('#total_amount').text(response.total_string);
                //     $("#product_price_" + cart_id).val(response.product_price);
                //     $(".vat_amount").text(response.vat_string);
                //     Msg.success('quantity changed successfully', 3000);
                // } else if (response.status == "error") {
                //     Msg.error('Unable To Process Your Request', 3000);
                // }
            });
        }
    </script>
@endpush
