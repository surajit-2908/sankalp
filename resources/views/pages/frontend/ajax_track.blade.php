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
                    <p class="orderNumber">#{{ $order->invoice_number }}</p>
                    <p class="orderTime">{{ date('h:i a, d M Y', strtotime($order->order_confirmed)) }}</p>
                    <div class="abpositation">
                        <ul class="orderTrack">
                            <li class="active">1</li>
                            <li class="active">2</li>
                            <li class="active">3</li>
                            <li class="active">4</li>
                            <li class="active">5</li>
                            <li class="active">6</li>
                            <li class="active">7</li>
                            <li class="active">8</li>
                            <li>9</li>
                            <li>10</li>
                        </ul>
                    </div>
                </li>
            @else
                <li class="orderConfirmed">
                    <h4>Confirm</h4>
                </li>
            @endif
            {{-- <p>{{ $order->order_confirmed_items }}</p>
            <p>{{ $order->order_confirmed_remarks }}</p> --}}

            @if ($order->production)
                <li class="orderConfirmed active">
                    <h4>{{ $order->packaging ? 'Order Released' : 'Order is in Production' }}</h4>
                    <p class="orderNumber">#{{ $order->invoice_number }}</p>
                    <p class="orderTime">{{ date('h:i a, d M Y', strtotime($order->production)) }}</p>
                    <div class="abpositation">
                        <ul class="orderTrack">
                            <li class="active">1</li>
                            <li class="active">2</li>
                            <li class="active">3</li>
                            <li class="active">4</li>
                            <li class="active">5</li>
                            <li class="active">6</li>
                            <li class="active">7</li>
                            <li class="active">8</li>
                            <li>9</li>
                            <li>10</li>
                        </ul>
                    </div>
                </li>
            @else
                <li class="statusProduction">
                    <h4>Production</h4>                    
                </li>
            @endif
            {{-- <p>{{ $order->production_items }}</p>
            <p>{{ $order->production_remarks }}</p> --}}

            @if ($order->packaging)
                <li class="orderConfirmed active">
                    <h4>{{ $order->delivery ? 'Order Packed' : 'Order is being Packed' }}</h4>
                    <p class="orderNumber">#{{ $order->invoice_number }}</p>
                    <p class="orderTime">{{ date('h:i a, d M Y', strtotime($order->packaging)) }}</p>                    
                </li>
            @else
                <li class="statusPacking">
                    <h4>Packing</h4>
                </li>
            @endif
            {{-- <p>{{ $order->packaging_items }}</p>
            <p>{{ $order->packaging_remarks }}</p> --}}

            @if ($order->delivery)
                <li class="orderConfirmed active">
                    <h4>Order Delivered</h4>
                    <p class="orderNumber">#{{ $order->invoice_number }}</p>
                    <p class="orderTime">{{ date('h:i a, d M Y', strtotime($order->delivery)) }}</p>
                </li>
            @else
                <li class="statusDelivery">
                    <h4>Delivery</h4>
                </li>
            @endif
            {{-- <p>{{ $order->delivery_items }}</p>
            <p>{{ $order->delivery_remarks }}</p> --}}

        </ul>
    </div>
@else
    <script>
        $(document).ready(function() {
            $("#invalid-invoice").show();
        })
    </script>
@endif
