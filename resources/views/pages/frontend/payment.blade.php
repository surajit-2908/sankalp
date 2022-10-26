@extends('layouts.layout')
@push('links')
    <link type="text/css" href="{{ asset('msg-alert-plugin/dist/css/bootstrap-msg.css') }}" rel="stylesheet">
    {{-- <script src="https://js.braintreegateway.com/web/dropin/1.8.1/js/dropin.min.js"></script> --}}
@endpush
@section('content')

    <div class="bodyBG">
        <div class="shopPagemain">
            <div class="container">
                <div class="breadcamp">
                    Home > Shop > Cart > Information > Shipping > Checkout > Payment
                </div>
                {{-- <h2 class="titleText">Make your payment</h2> --}}

                <div class="paymentSec flxcenter1">
                    {{-- <div class="paymentLeftCol">
                        <div class="payTopSec">

                            <div id="dropin-container"></div>
                            <button id="submit-button" class="shopBtn">Pay now</button>
                            <a href="{{ route('booking.success',['item']) }}" style="display:none;" id="payment_success"></a>
                        </div>
                    </div> --}}
                    @php
                        $total = round($subTotal + ($setting->vat / 100) * $subTotal + $setting->shipping_charge, 2);
                    @endphp
                    <div class="payColRightmin payColRight55">
                        <div class="payColRight">
                            <div class="priceSec">
                                <p><strong>Order summary</strong></p>
                                <div class="dFlex">
                                    <p>Subtotal</p>
                                    <p class="sub_total_amount">${{ number_format($subTotal, 2) }}</p>
                                </div>
                                <div class="dFlex">
                                    <p>Vat ({{ $setting->vat }}%)</p>
                                    <p class="vat_amount">${{ number_format(($setting->vat / 100) * $subTotal, 2) }}</p>
                                </div>
                                <div class="dFlex">
                                    <p>Shipping</p>
                                    <p>{{ $setting->shipping_charge ? "$" . number_format($setting->shipping_charge, 2) : 'Free' }}
                                    </p>
                                </div>
                                <div class="dFlex pTotalSec">
                                    <p>Total</p>
                                    <p class="sub_total_amount" id="sub_total_amount">
                                        ${{ $total }}
                                    </p>
                                </div>
                                <form action="{{ route('booking') }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="name"
                                        value="{{ Auth::user()->getFullNameAttribute() }}" />
                                    <script src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-key="{{ env('STRIPE_PUB_KEY') }}"
                                        data-amount="{{ $total * 100 }}" data-name="Make Payment" data-description="Pay Now and Confirm Your Booking"
                                        data-image="https://stripe.com/img/documentation/checkout/marketplace.png" data-locale="auto" data-currency="usd">
                                    </script>
                                </form>

                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    {{-- <div id="preloader" style="background-image: url({{ asset('assets/images/preloader.gif') }}); background-color: #fff;">
    </div> --}}
    {{-- <div id="payment-preloader" class="payment-preloader"
        style="background-image: url({{ asset('assets/images/payment-animation.gif') }}); display:none;">
    </div>
    <div id="preloader-success" class="payment-preloader"
        style="background-image: url({{ asset('assets/images/payment-success.gif') }}); display:none;">
    </div> --}}
@stop

@push('scripts')
    {{-- <script src="{{ asset('msg-alert-plugin/dist/js/bootstrap-msg.js') }}"></script>
    <script>
        var button = document.querySelector('#submit-button');
        braintree.dropin.create({
                authorization: "{{ $token }}",
                container: '#dropin-container',
                vaultManager: true,
                card: {
                    // vault: {
                    //     vaultCard: true,
                    //     allowVaultCardOverride: true
                    // },
                    overrides: {
                        styles: {
                            input: {
                                color: 'black',
                                'font-size': '18px'
                            },
                            '.number': {
                                'font-family': 'GothamBook'
                                // Custom web fonts are not supported. Only use system installed fonts.
                            },
                            '.invalid': {
                                color: 'red'
                            }
                        }
                    }
                },
            },
            function(createErr, instance) {
                $("#preloader").hide();
                button.addEventListener('click', function() {
                    instance.requestPaymentMethod(function(err, payload) {
                        if (!err)
                            $("#payment-preloader").show();
                        $.get('{{ route('booking') }}', {
                            payload
                        }, function(response) {
                            $("#payment-preloader").hide();
                            if (response.success) {
                                $("#preloader-success").show();
                                setTimeout(function() {
                                    $("#payment_success")[0].click();
                                }, 2000);
                            } else {
                                Msg.error('Unable To Process Your Request, Payment fail', 4000);
                            }
                        }, 'json');
                    });
                });
            });
    </script> --}}
@endpush
