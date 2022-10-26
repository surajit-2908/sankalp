@extends('layouts.admin-dashboard')
@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec variation-list-sec">
            <div class="category-list-hdn">
                <h2>Order Management</h2>
                <h3 class="create-cat">
                    {{-- <a href="{{ route('admin.online.training.add') }}">Add new Online Training</a> --}}
                </h3>
            </div>

            <div class="variation-list-area" id="showFilter">

                <!-- User List Area -->
                <div class="datatable">
                    <div class="card-body">
                        <table class="table" id="bootstrap-data-table">

                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Booking Number</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Total Amount</th>
                                    <th>Order Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($dataArr['bookingArr'] as $booking)
                                    <tr>
                                        <td title="User">
                                            {{ $booking->name }}
                                        </td>
                                        <td title="Booking Number">
                                            <a href="{{ route('admin.order.view', $booking->id) }}" title="View">
                                                <b class="text-info">#{{ $booking->booking_number }}</b>
                                            </a>
                                        </td>
                                        <td title="Phone">
                                            {{ $booking->phone }}
                                        </td>
                                        <td title="Address">
                                            {{ $booking->address }}
                                        </td>
                                        <td title="Total Amount">
                                            ${{ number_format($booking->total_amount, 2) }}
                                        </td>
                                        <td title="Order Date">
                                            {{ date('M d, Y H:i', strtotime($booking->created_at)) }}
                                        </td>
                                        <td>
                                            @php
                                                $date = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($booking->status_date)));
                                                $today = date('Y-m-d H:i:s');
                                            @endphp
                                            @if (@$booking->status == 'active')
                                                <span class="badge badge-success"> Active </span>
                                            @elseif(@$booking->status == 'wait_for_cancel')
                                                <span class="badge badge-danger"> Requested Cancellation </span>
                                            @elseif(@$booking->status == 'cancel')
                                                <span class="badge badge-danger"> Cancelled </span>
                                            @elseif(@$booking->status == 'delivered')
                                                <span class="badge badge-info"> Delivered </span>
                                            @elseif(@$booking->status == 'refunded')
                                                @if ($today > $date)
                                                    <span class="badge badge-danger"> Refunded </span>
                                                @else
                                                    <span class="badge badge-warning" title="Refund will be completed in 24 hours"> Cancelled </span>
                                                @endif
                                            @endif
                                        </td>
                                        <td title="Action">
                                            <div class="doted-dropdown">
                                                <p>...</p>
                                                <div class="doted-dropdown-content">
                                                    @if (@$booking->status == 'active')
                                                        <a href="{{ route('admin.order.status', [$booking->id, 'delivered']) }}"
                                                            title="Delivered" class="status-confirm">
                                                            <i class="fa fa-shopping-cart views"></i>
                                                        </a>
                                                        <a href="{{ route('admin.order.status', [$booking->id, 'cancel']) }}"
                                                            title="Cancel and Refund" class="cancel-confirm">
                                                            <i class="fa fa-times chat"></i>
                                                        </a>
                                                    @elseif (@$booking->status == 'wait_for_cancel')
                                                        <a href="{{ route('admin.order.status', [$booking->id, 'cancel']) }}"
                                                            title="Approve Cancellation & Refund" class="cancel-confirm">
                                                            <i class="fa fa-check chat"></i>
                                                        </a>
                                                    @endif
                                                    <a href="{{ route('admin.order.view', $booking->id) }}" title="View">
                                                        <i class="fa fa-eye listing"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Booking Status Section Start -->
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
