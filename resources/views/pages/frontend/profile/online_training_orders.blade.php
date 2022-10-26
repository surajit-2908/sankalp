@extends('layouts.layout')
@section('content')

    <div class="shopPagemain">
        <div class="container">
            <div class="breadcamp orderFlex">
                <div>Home > Profile > Online Traning Orders</div>
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
                <form action="{{ route('user.online.training.orders') }}">
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
                                $date = date_create(@$order->status_date);

                                $cal_date = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($order->status_date)));
                                $today = date('Y-m-d H:i:s');
                            @endphp
                            <li>
                                <div class="imgClm"onclick="window.location='{{ route('online.training') }}'">
                                    <img src="{{ asset('storage/online_training_file') . '/' . @$order->getOnlineTrainingDetail->image }}"
                                        alt="">
                                </div>
                                <div class="titleClm">
                                    <h2>Order number: {{ @$order->booking_number }}</h2>
                                    <p>{{ @$order->getOnlineTrainingDetail->title }}</p>
                                    <p><strong>Hours: {{ @$order->getOnlineTrainingDetail->hours }} </strong></p>
                                </div>
                                <div class="priceClm">${{ number_format($order->total_amount, 2) }}
                                </div>
                                <div class="deliveryDateClm">
                                    @if (@$order->status == 'delivered')
                                        <p class="deliDate">Delivered on
                                            {{ date_format($date, 'M d, Y') }}</p>
                                        <p>Your item has been delivered</p>
                                        @if (!$order->getOnlineTrainingRatingDetail)
                                            <p class="reviewProduct"
                                                onclick="window.location='{{ route('user.add.online.training.rating.review', [$order->booking_number, $order->getOnlineTrainingDetail->id]) }}'">
                                                Rate & Review Online Training
                                            </p>
                                        @endif
                                    @elseif (@$order->status == 'active')
                                        <p class="deliDate">Ordered on
                                            {{ date_format($date, 'M d, Y') }}</p>
                                        <p>Support team will contact you soon</p>
                                    @elseif (@$order->status == 'cancel')
                                        <p class="deliDate cancelDate">Cancelled on
                                            {{ date_format($date, 'M d, Y') }}</p>
                                        <p>Your order is cancelled</p>
                                    @elseif (@$order->status == 'refunded')
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
