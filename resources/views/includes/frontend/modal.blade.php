<!-- Search Modal -->
<div class="searchModal modal fade" id="headerSearchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <img src="{{ asset('assets/images/close-icon.png') }}" alt="">
            </button>
            <div class="modal-body">
                Search here...
            </div>
        </div>
    </div>
</div>



<!-- Order Track Modal -->
<div class="orderTrackModal modal fade" id="order_track_modal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <img src="{{ asset('assets/images/close-icon2.png') }}" alt="">
            </button>
            <div class="modal-body">
                <h2>Track your order here</h2>
                <form class="SKPformField">
                    <div class="FullWidthField">
                        <input type="text" name="" placeholder="Invoice number*">
                    </div>
                    <div class="FullWidthField">
                        <input type="email" name="" placeholder="Email address*">
                    </div>
                    <div class="FullWidthField">
                        <input type="submit" class="yellowBtn" name="" value="Track now">
                    </div>
                </form>

                <div class="modalOrderStatus">
                    <h3>Status</h3>
                    <ul>
                        <li class="statusOrder active">
                            <h4>Order</h4>
                        </li>
                        <li class="orderPlaced active">
                            <h4>Order placed</h4>
                            <p class="orderNumber">#12A394</p>
                            <p class="orderTime">09:10 AM, 9 May 2022</p>
                        </li>
                        <li class="orderConfirmed active">
                            <h4>Order is beeing confirmed</h4>
                            <p class="orderNumber">#12A394</p>
                            <p class="orderTime">09:10 AM, 9 May 2022</p>
                        </li>
                        <li class="statusProduction">
                            <h4>Production</h4>
                        </li>
                        <li class="statusPacking">
                            <h4>Packing</h4>
                        </li>
                        <li class="statusDelivery">
                            <h4>Delivery</h4>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
