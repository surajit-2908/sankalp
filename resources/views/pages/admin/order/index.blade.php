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
                                <th>Line Item</th>
                                <th>Order Confirmed</th>
                                <th>Production</th>
                                <th>Packaging</th>
                                <th>Delivery</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($dataArr['orderArr'] as $order)
                                @php
                                    $selected_items = '';
                                    // $selected_items = explode(", ",$order->order_confirmed_items);
                                @endphp
                                <tr>
                                    <td title="Invoice Number">
                                        <b>#{{ $order->invoice_number }}</b>
                                    </td>
                                    <td title="Company Name">
                                        {{ $order->getComapanyName->company_name }}
                                    </td>
                                    <td title="Line Item">
                                        {{ $order->quantity }}
                                    </td>
                                    <td title="Order Confirmed">
                                        {{-- @if (!$order->production) --}}
                                        <a href="javascript:void(0)" title="Order Confirmed" class="status-update"
                                            data-id="{{ $order->id }}" data-status="order_confirmed"
                                            data-quantity="{{ $order->quantity }}"
                                            data-selected="{{ $order->order_confirmed_items }}"
                                            data-remark="{{ $order->order_confirmed_remarks }}" data-items="" />
                                        {{-- @else
                                            <a href="javascript:void(0)" title="Order Confirmed">
                                        @endif --}}
                                        @if ($order->order_confirmed)
                                            <i class="fa fa-toggle-on chat"></i>
                                        @else
                                            <i class="fa fa-toggle-off chat"></i>
                                        @endif
                                        </a>
                                    </td>
                                    <td title="Production">
                                        {{-- @if (!$order->packaging && $order->order_confirmed) --}}
                                        <a href="javascript:void(0)" title="Production"
                                            @if ($order->order_confirmed) class="status-update" @endif
                                            data-id="{{ $order->id }}" data-status="production"
                                            data-quantity="{{ $order->quantity }}"
                                            data-selected="{{ $order->production_items }}"
                                            data-remark="{{ $order->production_remarks }}"
                                            data-items="{{ $order->order_confirmed_items }}" />
                                        {{-- @else
                                            <a href="javascript:void(0)" title="Production">
                                        @endif --}}
                                        @if ($order->production)
                                            <i class="fa fa-toggle-on chat"></i>
                                        @else
                                            <i class="fa fa-toggle-off chat"></i>
                                        @endif
                                        </a>
                                    </td>
                                    <td title="Packaging">
                                        {{-- @if (!$order->delivery && $order->production) --}}
                                        <a href="javascript:void(0)" title="Packaging"
                                            @if ($order->production) class="status-update" @endif
                                            data-id="{{ $order->id }}" data-status="packaging"
                                            data-quantity="{{ $order->quantity }}"
                                            data-selected="{{ $order->packaging_items }}"
                                            data-remark="{{ $order->packaging_remarks }}"
                                            data-items="{{ $order->production_items }}" />
                                        {{-- @else
                                            <a href="javascript:void(0)" title="Packaging">
                                        @endif --}}
                                        @if ($order->packaging)
                                            <i class="fa fa-toggle-on chat"></i>
                                        @else
                                            <i class="fa fa-toggle-off chat"></i>
                                        @endif
                                        </a>
                                    </td>
                                    <td title="Delivery">
                                        {{-- @if ($order->packaging) --}}
                                        <a href="javascript:void(0)" title="Delivery"
                                            @if ($order->packaging) class="status-update" @endif
                                            data-id="{{ $order->id }}" data-status="delivery"
                                            data-quantity="{{ $order->quantity }}"
                                            data-selected="{{ $order->delivery_items }}"
                                            data-remark="{{ $order->delivery_remarks }}"
                                            data-items="{{ $order->packaging_items }}" />
                                        {{-- @else
                                            <a href="javascript:void(0)" title="Delivery">
                                        @endif --}}
                                        @if ($order->delivery)
                                            <i class="fa fa-toggle-on chat"></i>
                                        @else
                                            <i class="fa fa-toggle-off chat"></i>
                                        @endif
                                        </a>
                                    </td>
                                    <td title="Action">
                                        @if (Auth::user()->admin_type == 'A')
                                            <a href="{{ route('admin.user.log', $order->id) }}" title="User Log">
                                                <i class="fa fa-eye chat"></i>
                                            </a>
                                        @endif
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
@push('modals')
    <!-- ===================== Admin Profile Update Modal Popup Start ===================== -->
    <div class="notification-modal-popup" id="myModalOrderStatus">
        <div class="noti-popup-box">
            <button class="noti-close-btn" onclick="$('#myModalOrderStatus').hide();">X</button>
            <div class="noti-pop-hdn">
                <h2>Order <span id="modal-heading"></span> Status</h2>
            </div>
            <div class="noti-pop-body">
                <div class="create-form">
                    <form method="POST" action="{{ route('admin.order.status') }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <input type="hidden" name="id" id="id" value="" />
                            <input type="hidden" name="status" id="status" value="" />
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label>Items</label>
                                    <div id="items" class="item-checks">
                                    </div>
                                    {{-- <select class="form-control" name="items[]" id="items" multiple="multiple">
                                    </select> --}}
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label>Remarks</label>
                                    <textarea name="remarks" id="remarks" rows="4" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="category-submit">
                            <ul>
                                <li>
                                    <button type="button" class="cancel-btn" onclick="$('#myModalOrderStatus').hide();">
                                        Cancel
                                    </button>
                                </li>
                                <li>
                                    <button type="submit" class="submit-btn subbtn">Submit</button>
                                </li>
                                </li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endpush
@push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.status-update').click(function() {
                let status = $(this).data('status');
                $("#items").html("");
                $('#id').val($(this).data('id'));
                $('#status').val(status);
                $('#remarks').val($(this).data('remark'));

                // get ready items for next status update
                let data_items = $(this).data('items').toString();

                if (data_items.length > 1)
                    data_items = $(this).data('items').split(",");
                // get selected items
                let selected_items = $(this).data('selected');

                // set data leangth or quantity
                let dataLength = 0;
                if (data_items != "")
                    dataLength = data_items.length;
                else
                    dataLength = $(this).data('quantity');

                let html = "";
                // loop to show items in modal
                for (let i = 1; i <= dataLength; i++) {
                    if (inArray(data_items[i - 1] ? data_items[i - 1] : i, selected_items))
                        html +=
                        `<div class="item-label"><input type="checkbox" class="for-check" id="quantity${i}" name="items[]" value="${data_items[i-1] ? data_items[i-1] : i}" checked="checked" onclick="return false"><label for="quantity${i}"> ${data_items[i-1] ? data_items[i-1] : i} </label></div>`;
                    else
                        html +=
                        `<div class="item-label"><input type="checkbox" class="for-check" id="quantity${i}" name="items[]" value="${data_items[i-1] ? data_items[i-1] : i}"><label for="quantity${i}"> ${data_items[i-1] ? data_items[i-1] : i} </label></div>`;
                }
                $("#items").append(html);
                if (status == 'order_confirmed')
                    status = 'confirmed';
                $("#modal-heading").html(status);

                $('#myModalOrderStatus').show();
            })
        })

        function inArray(needle, haystack) {
            var haystack_length = haystack.length;
            if (haystack_length > 1)
                var haystack_arr = haystack.split(",");
            else
                var haystack_arr = [haystack];

            for (var i = 0; i < 10; i++) {
                if (haystack_arr[i] == needle)
                    return true;
            }
            return false;
        }
    </script>
@endpush
