@extends('layouts.admin-dashboard')
@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec order-list-sec">
            <div class="category-list-hdn">
                <h2>Order Management</h2>
                <h3 class="create-cat">
                    <a href="{{ route('admin.order.add') }}">Add new order</a>
                </h3>
            </div>

            <div class="order-list-area" id="showFilter">

                <!-- User List Area -->
                <div class="datatable">
                    <div class="card-body">
                        <table class="table" id="bootstrap-data-table" style="width:100%">

                            <thead>
                                <tr>
                                    <th>Invoice Number</th>
                                    <th>Company Name</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($dataArr['orderArr'] as $order)
                                    <tr>
                                        <td title="Invoice Number">
                                            {{ $order->invoice_number }}
                                        </td>
                                        <td title="Company Name">
                                            {{ $order->getComapanyName->company_name }}
                                        </td>
                                        {{-- <td title="Action">
                                            <a href="{{ route('admin.order.edit', $order->id) }}" title="Edit">
                                                <i class="fa fa-edit listing"></i>
                                            </a>
                                            <a href="{{ route('admin.order.remove', $order->id) }}" title="Delete"
                                                class="delete-confirm">
                                                <i class="fa fa-trash chat"></i>
                                            </a>
                                        </td> --}}
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
