@extends('layouts.admin-dashboard')
@section('content')
    <h1 class="pageTitle mb20">Order Management</h1>
    <a class="addNew" href="{{ route('admin.order.add') }}"><i class="fa fa-plus"></i> Add New Order</a>
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec order-list-sec">


            <div class="order-list-area" id="showFilter">

                <!-- User List Area -->
                <div class="datatable table1">
                    <table class="table" id="bootstrap-data-table">
                        <thead>
                            <tr>
                                <th>Invoice Number</th>
                                <th>Company Name</th>
                                <th>Order Confirmed</th>
                                <th>Production</th>
                                <th>Packaging</th>
                                <th>Delivery</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($dataArr['orderArr'] as $order)
                                <tr>
                                    <td title="Invoice Number">
                                        <b>#{{ $order->invoice_number }}</b>
                                    </td>
                                    <td title="Company Name">
                                        {{ $order->getComapanyName->company_name }}
                                    </td>
                                    <td title="Order Confirmed">
                                        <a href="{{ route('admin.order.status', [$order->id, 'order_confirmed']) }}"
                                            title="Order Confirmed" class="status-confirm">
                                            @if ($order->order_confirmed)
                                                <i class="fa fa-toggle-on chat"></i>
                                            @else
                                                <i class="fa fa-toggle-off chat"></i>
                                            @endif
                                        </a>
                                    </td>
                                    <td title="Production">
                                        <a href="{{ route('admin.order.status', [$order->id, 'production']) }}"
                                            title="Production" class="status-confirm">
                                            @if ($order->production)
                                                <i class="fa fa-toggle-on chat"></i>
                                            @else
                                                <i class="fa fa-toggle-off chat"></i>
                                            @endif
                                        </a>
                                    </td>
                                    <td title="Packaging">
                                        <a href="{{ route('admin.order.status', [$order->id, 'packaging']) }}"
                                            title="Packaging" class="status-confirm">
                                            @if ($order->packaging)
                                                <i class="fa fa-toggle-on chat"></i>
                                            @else
                                                <i class="fa fa-toggle-off chat"></i>
                                            @endif
                                        </a>
                                    </td>
                                    <td title="Delivery">
                                        <a href="{{ route('admin.order.status', [$order->id, 'delivery']) }}"
                                            title="Delivery" class="status-confirm">
                                            @if ($order->delivery)
                                                <i class="fa fa-toggle-on chat"></i>
                                            @else
                                                <i class="fa fa-toggle-off chat"></i>
                                            @endif
                                        </a>
                                    </td>
                                    <td title="Action">
                                        {{-- <a href="{{ route('admin.order.edit', $order->id) }}" title="Edit">
                                        <i class="fa fa-edit listing"></i>
                                    </a> --}}
                                        <a href="{{ route('admin.order.remove', $order->id) }}" title="Delete"
                                            class="delete-confirm">
                                            <i class="fa fa-trash chat"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- Booking Status Section Start -->
@stop
