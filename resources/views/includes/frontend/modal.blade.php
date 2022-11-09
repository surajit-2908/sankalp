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
            <button type="button" class="close" id="close-tracking" data-dismiss="modal" aria-label="Close">
                <img src="{{ asset('assets/images/close-icon2.png') }}" alt="">
            </button>
            <div class="modal-body">
                <h2>Track your order here</h2>

                <form class="SKPformField">
                    <div class="msg-div" id="invalid-invoice" style="display:none;">
                        <p class="alert alert-danger"><strong>Invalid Invoice Number</strong></p>
                    </div>
                    <div class="FullWidthField">
                        <input type="text" name="invoice_number" id="invoice_number" placeholder="Invoice number*">
                        <label class="error" id="invoice_number_error" style="display:none;">Please enter a valid
                            invoice number</label>
                    </div>
                    <div class="FullWidthField">
                        <input type="email" name="email" id="email" placeholder="Email address*">
                        <label class="error" id="email_error" style="display:none;">Please enter a valid email</label>
                    </div>
                    <div class="FullWidthField">
                        <input type="button" class="yellowBtn" id="track-button" value="Track now">
                    </div>
                </form>

                <div id="modalOrderStatus">

                </div>
            </div>
        </div>
    </div>
</div>
