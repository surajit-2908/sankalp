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
                    Home > Online Training > Payment
                </div>

                <div class="paymentSec flxcenter1">
                    {{-- <div class="paymentLeftCol">
                        <div class="payTopSec">

                            <div id="dropin-container"></div>
                            <button id="submit-button" class="shopBtn">Pay now</button>
                            <a href="{{ route('booking.success',['online-training']) }}" style="display:none;" id="payment_success"></a>
                        </div>
                    </div> --}}
                    @php
                        $total = round($onlineTraining->selling_price, 2);
                    @endphp
                    <div class="payColRightmin payColRight55">
                        <div class="payColRight">
                            <div class="priceSec">
                                <p><strong>Order summary</strong></p>
                                <div class="dFlex">
                                    <p>Price</p>
                                    <p class="vat_amount">${{ number_format($onlineTraining->price, 2) }}</p>
                                </div>
                                <div class="dFlex">
                                    <p><b>Discount</b></p>
                                    <p class="vat_amount">
                                        <b>-
                                            ${{ number_format($onlineTraining->price - $onlineTraining->selling_price, 2) }}</b>
                                    </p>
                                </div>
                                {{-- <div class="dFlex">
                                    <p>Offer Price</p>
                                    <p class="vat_amount">${{ number_format($onlineTraining->selling_price, 2) }}</p>
                                </div> --}}
                                <div class="dFlex pTotalSec">
                                    <p>Total</p>
                                    <p class="sub_total_amount" id="sub_total_amount">
                                        ${{ $total }}
                                    </p>
                                </div>
                                <form action="{{ route('online.training.booking', $onlineTraining->id) }}" method="POST">
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
    </div>
    <div id="payment-preloader" class="payment-preloader"
        style="background-image: url({{ asset('assets/images/payment-animation.gif') }}); display:none;">
    </div>
    <div id="preloader-success" class="payment-preloader"
        style="background-image: url({{ asset('assets/images/payment-success.gif') }}); display:none;">
    </div> --}}
@stop
{{--
@push('scripts')
    <script src="{{ asset('msg-alert-plugin/dist/js/bootstrap-msg.js') }}"></script>
    <script>
        var button = document.querySelector('#submit-button');
        braintree.dropin.create({
            authorization: "{{ $token }}",
            container: '#dropin-container',
            vaultManager: true,
            card: {
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
            // paypal: {
            //     flow: 'vault'
            // },
        }, function(createErr, instance) {
            $("#preloader").hide();
            button.addEventListener('click', function() {
                instance.requestPaymentMethod(function(err, payload) {
                    if (!err)
                        $("#payment-preloader").show();
                    $.get('{{ route('online.training.booking', $onlineTraining->id) }}', {
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
    </script>
@endpush --}}
