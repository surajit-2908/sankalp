@extends('layouts.layout')
@section('content')

    <div class="shopPagemain">
        <div class="container">
            <div class="breadcamp orderFlex">
                <div>Home > Profile > My Orders</div>
                <div class="orderLinktext">
                    <a href="{{ route('user.my.orders') }}" @if (Route::is('user.my.orders')) class="active" @endif>Item
                        Orders</a>
                    <a href="{{ route('user.online.training.orders') }}"
                        @if (Route::is('user.online.training.orders')) class="active" @endif>Online Traning Orders</a>
                </div>
            </div>


            <div class="myOrderBodyArea">
                @include('includes.frontend.message')
                <h1 class="pageTitle">My Orders</h1>
                <form action="{{ route('user.my.orders') }}">
                    <div class="srchOrdrPrt">
                        <input class="formcontrol" placeholder="Search your ordrs here by order number" type="search"
                            name="search" value="{{ @request()->input('search') }}">
                        <button class="ordrSrchBtn pinkBtn" type="submit">Search orders</button>
                    </div>
                </form>

                <div class="ordrListArea">
                    <ul>
                        @forelse ($orders as $order)
                            @php
                                $variationArr = json_decode($order->variation_combination);
                                $date = date_create(@$order->getBooking->status_date);

                                $cal_date = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($order->getBooking->status_date)));
                                $today = date('Y-m-d H:i:s');

                                if (@$charges != @$order->getBooking->booking_number) {
                                    $charges = @$order->getBooking->booking_number;
                                    $amount = $order->amount + @$order->getBooking->vat + @$order->getBooking->shipping_charge;
                                    $charges_msg = 'Vat and Shipping charges applied.';
                                } else {
                                    $charges_msg = '';
                                    $amount = $order->amount;
                                }
                            @endphp
                            <li>
                                <div class="imgClm"
                                    onclick="window.location='{{ route('product.detail', $order->getProductDetail->slug) }}'">
                                    <img src="{{ asset('storage/product_image') . '/' . @$order->getProductDetail->image }}"
                                        alt="">
                                </div>
                                <div class="titleClm">
                                    <h2>Order number: {{ @$order->getBooking->booking_number }}</h2>
                                    <p>{{ @$order->getProductDetail->title }}</p>
                                    @if ($variationArr)
                                        @foreach (@$variationArr as $variation => $varOpt)
                                            <p><strong>{{ $variation }} -</strong> {{ $varOpt[0] }}</p>
                                        @endforeach
                                    @endif
                                    <p><strong>Quantity - </strong>{{ $order->quantity }}</p>
                                </div>
                                <div class="priceClm">${{ $amount }}
                                    @if ($charges_msg)
                                        <p class="text-danger charges_msg" data-id="{{ $order->id }}">
                                            <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                                            {{ $charges_msg }}
                                        </p>
                                        <div class="tooltip-sec tooltip_{{ $order->id }}" style="display: none;">
                                            <div class="dFlex">
                                                <p>Product Price</p>
                                                <p>${{ number_format($order->amount, 2) }}</p>
                                            </div>
                                            <div class="dFlex">
                                                <p>Vat
                                                    ({{ $order->getBooking->vat ? round(($order->getBooking->vat * 100) / $order->getBooking->subtotal_amount) : '0' }}%)
                                                </p>
                                                <p>
                                                    ${{ number_format(@$order->getBooking->vat, 2) }}
                                                </p>
                                            </div>
                                            <div class="dFlex">
                                                <p>Shipping Charge</p>
                                                <p>{{ $order->getBooking ? "$" . number_format($order->getBooking->shipping_charge, 2) : 'Free' }}
                                                </p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="deliveryDateClm">
                                    @if (@$order->getBooking->status == 'delivered')
                                        <p class="deliDate">Delivered on
                                            {{ date_format($date, 'M d, Y') }}</p>
                                        <p>Your item has been delivered</p>
                                        @if (!orderProductRating(Auth::id(), $order->getBooking->booking_number, $order->getProductDetail->id))
                                            <p class="reviewProduct"
                                                onclick="window.location='{{ route('user.rating.review', [$order->getBooking->booking_number, $order->getProductDetail->slug]) }}'">
                                                Rate & Review Product
                                                {{-- Update Product Rate & Review
                                                    @else --}}
                                            </p>
                                        @endif
                                    @elseif (@$order->getBooking->status == 'active')
                                        <p class="deliDate">Ordered on
                                            {{ date_format($date, 'M d, Y') }}</p>
                                        <p>Your item will be delivered soon</p>
                                    @elseif (@$order->getBooking->status == 'wait_for_cancel')
                                        <p class="deliDate cancelDate">Cancellation requested on
                                            {{ date_format($date, 'M d, Y') }}</p>
                                        <p>Your item cancellation request waiting for approval</p>
                                    @elseif (@$order->getBooking->status == 'cancel')
                                        <p class="deliDate cancelDate">Cancelled on
                                            {{ date_format($date, 'M d, Y') }}</p>
                                        <p>Your order is cancelled</p>
                                    @elseif (@$order->getBooking->status == 'refunded')
                                        <p class="deliDate cancelDate">Cancelled on
                                            {{ date_format($date, 'M d, Y') }}</p>
                                        @if ($today > $cal_date)
                                            <p>Refund completed</p>
                                        @else
                                            <p>Refund will be done in 24 hours</p>
                                        @endif
                                    @endif
                                </div>
                            </li>
                        @empty
                            <li>Orders is empty</li>
                        @endforelse
                    </ul>
                </div>
            </div>
            <div class="pagignation">
                {{ $orders->appends(request()->input())->render('vendor.pagination.default') }}
            </div>

        </div>
    </div>
@stop
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.charges_msg').hover(function() {
                let id = $(this).data('id');
                $(`.tooltip_${id}`).toggle();
            });
        });
    </script>
@endpush
