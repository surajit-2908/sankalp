@if ($order)
    <script>
        $(document).ready(function() {
            $("#invalid-invoice").hide();
        })
    </script>
    <div class="modalOrderStatus">
        <h3>Status</h3>
        <ul>
            <li class="statusOrder active">
                <h4>Order</h4>
            </li>

            <li class="orderPlaced active">
                <h4>Order placed</h4>
                <p class="orderNumber">#{{ $order->invoice_number }}</p>
                <p class="orderTime">{{ date('h:i a, d M Y', strtotime($order->created_at)) }}</p>
            </li>

            @if ($order->order_confirmed)
                <li class="orderConfirmed active">
                    <h4>{{ $order->production ? 'Order Confirmed' : 'Order is being confirmed' }}</h4>
                    <p class="orderNumber">{{ $order->order_confirmed_remarks }}</p>
                    <p class="orderTime">{{ date('h:i a, d M Y', strtotime($order->order_confirmed)) }}</p>
                    <div class="abpositation">
                        <ul class="orderTrack">
                            @php
                                $order_confirmed_item_arr = explode(',', $order->order_confirmed_items);
                            @endphp
                            @for ($i = 1; $i <= $order->quantity; $i++)
                                <li @if (in_array($i, $order_confirmed_item_arr)) class="active" @endif>{{ $i }}</li>
                            @endfor
                        </ul>
                    </div>
                </li>
            @else
                <li class="orderConfirmed">
                    <h4>Confirm</h4>
                </li>
            @endif

            @if ($order->production)
                <li class="orderConfirmed active">
                    <h4>{{ $order->packaging ? 'Order Released' : 'Order is in Production' }}</h4>
                    <p class="orderNumber">{{ $order->production_remarks }}</p>
                    <p class="orderTime">{{ date('h:i a, d M Y', strtotime($order->production)) }}</p>
                    <div class="abpositation">
                        <ul class="orderTrack">
                            @php
                                $production_item_arr = explode(',', $order->production_items);
                            @endphp
                            @for ($i = 1; $i <= $order->quantity; $i++)
                                <li @if (in_array($i, $production_item_arr)) class="active" @endif>{{ $i }}</li>
                            @endfor
                        </ul>
                    </div>
                </li>
            @else
                <li class="statusProduction">
                    <h4>Production</h4>
                </li>
            @endif

            @if ($order->packaging)
                <li class="orderConfirmed active">
                    <h4>{{ $order->delivery ? 'Order Packed' : 'Order is being Packed' }}</h4>
                    <p class="orderNumber">{{ $order->packaging_remarks }}</p>
                    <p class="orderTime">{{ date('h:i a, d M Y', strtotime($order->packaging)) }}</p>
                    <div class="abpositation">
                        <ul class="orderTrack">
                            @php
                                $packaging_item_arr = explode(',', $order->packaging_items);
                            @endphp
                            @for ($i = 1; $i <= $order->quantity; $i++)
                                <li @if (in_array($i, $packaging_item_arr)) class="active" @endif>{{ $i }}</li>
                            @endfor
                        </ul>
                    </div>
                </li>
            @else
                <li class="statusPacking">
                    <h4>Packing</h4>
                </li>
            @endif

            @if ($order->delivery)
                <li class="orderConfirmed active">
                    <h4>Order Delivered</h4>
                    <p class="orderNumber">{{ $order->delivery_remarks }}</p>
                    <p class="orderTime">{{ date('h:i a, d M Y', strtotime($order->delivery)) }}</p>
                    <div class="abpositation">
                        <ul class="orderTrack">
                            @php
                                $delivery_item_arr = explode(',', $order->delivery_items);
                            @endphp
                            @for ($i = 1; $i <= $order->quantity; $i++)
                                <li @if (in_array($i, $delivery_item_arr)) class="active" @endif>{{ $i }}</li>
                            @endfor
                        </ul>
                    </div>
                </li>
            @else
                <li class="statusDelivery">
                    <h4>Delivery</h4>
                </li>
            @endif

        </ul>
    </div>
@else
    <script>
        $(document).ready(function() {
            $("#invalid-invoice").show();
        })
    </script>
@endif
