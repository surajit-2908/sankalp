@extends('layouts.admin-dashboard')
@push('links')
    <style type="text/css">
        .btn-sm {
            padding: 0.05rem .35rem;
        }

        .book-room .present-field {
            width: 24%;
        }

        .light-color {
            background: #f0fffe;
        }

        .dark-color {
            background: #d4fcf9;
        }

        table tr td {
            background: none !important;
        }
    </style>
@endpush
@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec category-list-sec">
            <div class="category-list-hdn">
                <h2>Order Details Of <i class="text-danger">#{{ @$dataArr['bookingDetail']->booking_number }}</i></h2>
                <h3 class="create-cat">
                    <a href="{{ route('admin.order') }}">Back</a>
                </h3>
            </div>

            <div class="category-list-area" id="showFilter">

                <div class="datatable">
                    <div class="card-body pro-describe">
                        <div class="land-data-sec presentContent">
                            <div class="land-data-col" style="width: 100%; margin-bottom: 15px;">
                                <div class="present_prt">
                                    <div class="button_prt"></div>

                                    <div class="present-field">
                                        <label>Name</label>
                                        <span class="show-span">{{ @$dataArr['bookingDetail']->name }}</span>
                                    </div>

                                    <div class="present-field">
                                        <label>Phone</label>
                                        <span class="show-span">{{ @$dataArr['bookingDetail']->phone }}</span>
                                    </div>

                                    @php
                                        $date = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($dataArr['bookingDetail']->status_date)));
                                        $today = date('Y-m-d H:i:s');
                                    @endphp
                                    <div class="present-field">
                                        <label>Status</label>
                                        <span class="show-span">
                                            @if (@$dataArr['bookingDetail']->status == 'active')
                                                <b class="text-success"> Active </b>
                                            @elseif(@$dataArr['bookingDetail']->status == 'wait_for_cancel')
                                                <small class="text-danger"><b>Requested Cancellation</b></small>
                                            @elseif(@$dataArr['bookingDetail']->status == 'cancel')
                                                <b class="text-danger"> Cancelled </b>
                                            @elseif(@$dataArr['bookingDetail']->status == 'delivered')
                                                <b class="text-info"> Delivered </b>
                                            @elseif(@$dataArr['bookingDetail']->status == 'refunded')
                                                @if ($today > $date)
                                                    <b class="text-danger"> Refunded </b>
                                                @else
                                                    <b class="text-warning" title="Refund will be completed in 24 hours"> Cancelled </b>
                                                @endif
                                            @endif
                                        </span>
                                    </div>

                                    <div class="present-field" style="width: 100%;">
                                        <label style="width: 16%;">Address</label>
                                        <span class="show-span">{{ @$dataArr['bookingDetail']->address }}</span>
                                    </div>

                                    <div class="present-field">
                                        <label>Subtotal</label>
                                        <span
                                            class="show-span">${{ number_format(@$dataArr['bookingDetail']->subtotal_amount, 2) }}</span>
                                    </div>

                                    <div class="present-field">
                                        <label>Vat</label>
                                        <span
                                            class="show-span">${{ number_format(@$dataArr['bookingDetail']->vat, 2) }}</span>
                                    </div>

                                    <div class="present-field">
                                        <label>Shipping Charge</label>
                                        <span
                                            class="show-span">${{ number_format(@$dataArr['bookingDetail']->shipping_charge, 2) }}</span>
                                    </div>

                                    <div class="present-field" style="width: 100%;">
                                        <label style="width: 16%;">Total Amount</label>
                                        <span
                                            class="show-span">${{ number_format(@$dataArr['bookingDetail']->total_amount, 2) }}
                                            <sub class="text-danger">(Subtotal+Vat+Shipping Charge)</sub></span>
                                    </div>

                                </div>
                            </div>


                            @if (count(@$dataArr['bookingDetail']->getBookingDetail))
                                <div class="land-data-col" style="width: 100%; margin-top: 25px;">
                                    <div class="present_prt">
                                        <h2>Ordered Item Details</h2>
                                        <!-- <div class="button_prt"></div> -->

                                        <table class="orderTabl">
                                            <tr align="center">
                                                <th>Item</th>
                                                <th>Variation</th>
                                                <th>Quantity</th>
                                                <th>Amount</th>
                                            </tr>
                                            @foreach ($dataArr['bookingDetail']->getBookingDetail as $key => $bookingDetail)
                                                @php
                                                    $variationArr = json_decode($bookingDetail->variation_combination);
                                                    $date = date_create(@$bookingDetail->getBooking->status_date);
                                                @endphp
                                                <tr class="{{ $key % 2 == 0 ? 'light-color' : 'dark-color' }}">
                                                    <td onclick="window.location='{{ route('admin.product.detail', $bookingDetail->getProductDetail->id) }}'"
                                                        style="cursor: pointer;">
                                                        <img src="{{ asset('storage/product_image') . '/' . $bookingDetail->getProductDetail->image }}"
                                                            alt="" class="bnr-img">
                                                        <h3>{{ @$bookingDetail->getProductDetail->title }}</h3>
                                                    </td>
                                                    <td>
                                                        @if ($variationArr)
                                                            @foreach (@$variationArr as $variation => $varOpt)
                                                                <p><strong>{{ $variation }} -</strong>
                                                                    {{ $varOpt[0] }}</p>
                                                            @endforeach
                                                        @else
                                                            -----
                                                        @endif
                                                    </td>
                                                    <td>{{ @$bookingDetail->quantity }}</td>
                                                    <td>${{ number_format(@$bookingDetail->amount, 2) }}</td>
                                                </tr>
                                            @endforeach
                                        </table>

                                    </div>
                                </div>
                            @endif

                            @if (@$dataArr['bookingDetail']->status == 'cancel' ||
                                @$dataArr['bookingDetail']->status == 'wait_for_cancel' ||
                                @$dataArr['bookingDetail']->status == 'refunded')
                                <div class="land-data-col" style="width: 100%; margin-top: 15px;">
                                    <div class="present_prt">
                                        <div class="button_prt"></div>

                                        <div class="present-field" style="width: 47%;">
                                            <label style="width: 77%;">Cancellation
                                                {{ @$dataArr['bookingDetail']->status == 'wait_for_cancel' ? 'applied' : '' }}
                                                Date</label>
                                            <span class="show-span">
                                                {{ date('M d, Y', strtotime(@$dataArr['bookingDetail']->status_date)) }}</span>
                                        </div>

                                        <div class="present-field" style="width: 47%;">
                                            <label>Refunded Amount</label>
                                            <span class="show-span">
                                                ${{ number_format(@$dataArr['bookingDetail']->total_amount - @$dataArr['bookingDetail']->refund_charge, 2) }}
                                                <sub class="text-danger">(Refund Charge
                                                    ${{ number_format(@$dataArr['bookingDetail']->refund_charge, 2) }})</sub>
                                            </span>
                                        </div>

                                        @if (@$dataArr['bookingDetail']->status == 'wait_for_cancel')
                                            <div class="button_apprv">
                                                <a href="{{ route('admin.order.status', [$dataArr['bookingDetail']->id, 'cancel']) }}"
                                                    title="Approve Cancellation & Refund" class="cancel-confirm">
                                                    <span class="btn btn-outline-danger btn-sm"
                                                        style="background-color: #dc3545;">
                                                        Approve Cancellation & Refund
                                                    </span>
                                                </a>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            @endif


                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@stop
@push('script')
    <script>
        $('.cancel-confirm').on('click', function(event) {
            event.preventDefault();
            const url = $(this).attr('href');
            swal({
                title: 'Are you sure?',
                text: 'Do you really want to cancel this order!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    window.location.href = url;
                }
            });
        });
    </script>
@endpush
