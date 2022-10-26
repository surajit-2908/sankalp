@php
// $middle_of_title = strrpos(substr($productDetail->title, 0, floor(strlen($productDetail->title) / 2)), ' ') + 1;

// $ftitle = substr($productDetail->title, 0, $middle_of_title);
// $ltitle = substr($productDetail->title, $middle_of_title);

if (count(explode(' ', $productDetail->title)) == 1) {
    $ftitle = $productDetail->title;
    $ltitle = '';
} else {
    $ftitle = substr($productDetail->title, 0, floor(strlen($productDetail->title) / 2));
    $ltitle = substr($productDetail->title, floor(strlen($productDetail->title) / 2));
}

$feautres1 = [];
$feautres2 = [];
if ($productDetail->feautres) {
    $feautres = explode(',', $productDetail->feautres);
    if (count($feautres) > 1) {
        [$feautres1, $feautres2] = array_chunk($feautres, ceil(count($feautres) / 2));
    } else {
        $feautres1 = $feautres;
    }
}
@endphp
@extends('layouts.layout')
@push('links')
    {{-- <link type="text/css" href="{{ asset('assets/css/horizontalvertical.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/xzoom.css') }}" media="all" />
    <link type="text/css" href="{{ asset('msg-alert-plugin/dist/css/bootstrap-msg.css') }}" rel="stylesheet">
@endpush
@section('content')


    <div class="shopPagemain">
        <div class="container">
            <div class="breadcamp">
                Home > Shop > Product Details
            </div>

            <div class="productDetailsSec">
                <div class="productDetailsCol">
                    {{-- <div class="horVerSlider" data-desktop="800" data-tabportrait="600" data-tablandscape="600"
                        data-mobilelarge="375" data-mobilelandscape="500" data-mobileportrait="375">

                        <div class="vertical-wrapper">
                            <div id="vertical-slider">
                                <ul>
                                    @foreach ($productDetail->getImages as $productThImg)
                                        <li data-image="{{ asset('storage/product_image') . '/' . $productThImg->thumb_image_name }}"
                                            class="ui-draggable ui-draggable-handle ui-draggable-disabled"></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="horizon-wrapper ">

                            <div id="horizon-slider" class="zoomin zoomenable zoomed">
                                <ul style="width: 6000px; height: 615px; left: 0px; top: 0px;">
                                    @foreach ($productDetail->getImages as $productImg)
                                        <li data-image="{{ asset('storage/product_image') . '/' . $productImg->image_name }}"
                                            class="ui-draggable ui-draggable-handle ui-draggable-disabled"></li>
                                    @endforeach
                                </ul>
                            </div>

                        </div>
                    </div> --}}

                    <!-- lens options start -->
                    <section id="lens">
                        <div class="large-5 column">
                            <div class="xzoom-container">
                                <div class="zoomBigimg">
                                    <img class="xzoom3"
                                        src="{{ asset('storage/product_preview_image') . '/' . $productDetail->getImages[0]->image_name }}"
                                        xoriginal="{{ asset('storage/product_image') . '/' . $productDetail->getImages[0]->image_name }}" />
                                </div>
                                <div class="xzoom-thumbs">
                                    @foreach ($productDetail->getImages as $productImg)
                                        <a
                                            href="{{ asset('storage/product_image') . '/' . $productImg->image_name }}"><img
                                                class="xzoom-gallery3" width="98"
                                                src="{{ asset('storage/product_preview_image') . '/' . $productImg->image_name }}"
                                                title="{{ $productDetail->title }}"></a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="large-7 column"></div>
                    </section>
                    <!-- lens options end -->
                </div>

                <div class="productDetailsRightCol">
                    <h2 class="titleText"><span>{{ $ftitle }} </span>
                        {{ $ltitle }}</h2>
                    <p class="price"><del>${{ number_format($productDetail->selling_price, 2) }}</del>
                        ${{ number_format($productDetail->selling_offer_price, 2) }}

                    </p>
                    <form action="{{ route('buy.now', $productDetail->id) }}" id='myform' method='POST'>
                        {{ csrf_field() }}
                        @if ($productDetail->quantity && $avail_quan)
                            <div class="quantitySec">
                                <p>Quantity</p>
                                <div class="quantityCol">
                                    <input type='button' value='-' class='qtyminus disabled-btn' field='quantity' />
                                    <input type='text' name='quantity' id='quantity'
                                        value='{{ $productDetail->quantity ? '1' : '0' }}' class='qty' />
                                    <input type='button' value='+'
                                        class='qtyplus {{ !$productDetail->quantity ? 'disabled-btn' : '' }}'
                                        field='quantity' />
                                    <input type='hidden' name='available_quantity' id='available_quantity'
                                        value="{{ $avail_quan }}" />

                                </div>
                            </div>
                        @endif
                        @forelse ($productDetail->getProductVariants as $key => $productVariant)
                            @php
                                $var_opt = explode(',', $productVariant->variation_option_string);
                            @endphp
                            <div class="dFlex slSize">



                                <p>Select {{ $productVariant->getVar->name }}</p>
                                <div class="buttons">

                                    {{-- <div class="selecotritem">
                                        <input type="radio" id="radio{{ $key }}" name="selector"
                                            class="selectoritemradio" checked>
                                        <label for="radio{{ $key }}" class="selectoritemlabel">radio
                                            {{ $key }}</label>
                                    </div>
                                    <div class="selecotritem">
                                        <input type="radio" id="radio{{ $key + 1 }}" name="selector"
                                            class="selectoritemradio">
                                        <label for="radio{{ $key + 1 }}" class="selectoritemlabel">radio
                                            {{ $key + 1 }}</label>
                                    </div> --}}

                                    @foreach ($productVariant->getVarOpt as $varOpt)
                                        @if (in_array($varOpt->id, $var_opt))
                                            <div class="selecotritem">
                                                <input type="radio" id="variation_combination{{ $varOpt->id }}"
                                                    name="variation_combination[{{ $productVariant->getVar->name }}][]"
                                                    value="{{ $varOpt->name }}" class="selectoritemradio">
                                                <label for="variation_combination{{ $varOpt->id }}"
                                                    class="selectoritemlabel"> {{ $varOpt->name }}
                                                </label>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @empty
                            <div class="dFlex slSize">
                                <div class="buttons"></div>
                            </div>
                        @endforelse
                        @if ($productDetail->quantity)
                            @auth
                                @if ($avail_quan)
                                    <a href="javascript:void(0)" class="blackBtn mngBtn cartBtn smBtn">Add to Bag</a>
                                    <button type="submit" class="pinkBtn smBtn">Buy Now</button>
                                @endif
                            @else
                                <a href="{{ route('user.login', $productDetail->slug) }}" class="blackBtn smBtn">Add to
                                    Bag</a>
                                <button type="button" class="pinkBtn smBtn"
                                    onclick="window.location='{{ route('user.login', $productDetail->slug) }}'">Buy
                                    Now</button>
                            @endauth
                        @else
                            <button type="button" class="pinkBtn soldOutBtn disableBtn">Sold Out</button>
                        @endif
                        <a href="{{ route('user.cart') }}" class="pinkBtn smBtn goCart"
                            @if (!$productDetail->quantity || $avail_quan) style="display: none;" @endif>Go to Cart</a>
                    </form>

                </div>
            </div>


            <div class="tabSec">
                <ul class="tabs">
                    <li class="active" rel="tab1">Products Details</li>
                    <li rel="tab2">Shopping & Returns</li>
                    <li rel="tab3">FAQ</li>
                </ul>
                <div class="tab_container">
                    <h3 class="d_active tab_drawer_heading" rel="tab1">Products Details</h3>
                    <div id="tab1" class="tab_content">
                        <p>{!! $productDetail->long_description !!}</p>
                        <h3>Features</h3>
                        <div class="featuresSec">
                            <ul>
                                @foreach ($feautres1 as $feautres1)
                                    <li>{!! $feautres1 !!}</li>
                                @endforeach
                            </ul>
                            <ul>
                                @foreach ($feautres2 as $feautres2)
                                    <li>{!! $feautres2 !!}</li>
                                @endforeach
                            </ul>
                        </div>
                        @if (count($productDetail->getRatingReview))
                            <h3>Reviews</h3>
                            @foreach ($productDetail->getRatingReview as $ratingReview)
                                @php
                                    $emptyStar = 5 - $ratingReview->rating;
                                @endphp
                                <div class="reviewClm">
                                    <h3>{{ $ratingReview->title }}</h3>
                                    <div class="dFlex reviewsSec">
                                        <ul>
                                            @for ($i = 1; $i <= $ratingReview->rating; $i++)
                                                <li class="active"><i class="fa fa-star"></i></li>
                                            @endfor
                                            @for ($i = 1; $i <= $emptyStar; $i++)
                                                <li><i class="fa fa-star"></i></li>
                                            @endfor
                                        </ul>
                                        <span>{{ $ratingReview->rating }}<i class="fa fa-star"
                                                aria-hidden="true"></i></span>
                                    </div>
                                    <p>{{ $ratingReview->description }}</p>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <!-- #tab1 -->
                    <h3 class="tab_drawer_heading" rel="tab2">Shopping & Returns</h3>
                    <div id="tab2" class="tab_content">
                        <p>{!! $productDetail->shopping_returns !!}</p>
                    </div>
                    <!-- #tab2 -->
                    <h3 class="tab_drawer_heading" rel="tab3">FAQ</h3>
                    <div id="tab3" class="tab_content">

                        @foreach (@$productDetail->getProductFaqs as $productFaq)
                            <div class="faq-div">
                                <p><b>Q: {{ $productFaq->question }}</b></p>
                                <p><b>A:</b> {{ $productFaq->answer }}</p>
                            </div>
                        @endforeach
                    </div>
                    <!-- #tab3 -->

                </div>
                <!-- .tab_container -->
            </div>
        </div>

    </div>


    <div class="likePro">
        <div class="container">
            <div class="dFlex">
                <h2 class="titleText">products you may like</h2>
                <a href="{{ route('shop', $slug) }}" class="shopBtn">View all</a>
            </div>
            <div class="productSecList prodetailsList">
                <div id="product_scroller" class="owl-carousel">
                    @foreach ($products as $product)
                        @php
                            $ratingCount = ratingCal($product->id)['ratingCount'];
                            if ($ratingCount) {
                                $ratingCountStr = $ratingCount . ($ratingCount > 1 ? ' reviews' : ' review');
                            } else {
                                $ratingCountStr = '';
                            }
                            $avgRating = round(ratingCal($product->id)['avgRating']);
                            $empty_star = 5 - round(ratingCal($product->id)['avgRating']);
                        @endphp
                        <div class="item" onclick="window.location='{{ route('product.detail', $product->slug) }}'">
                            <div class="productsCol">
                                <span class="imgBox"><img alt="icon"
                                        src="{{ asset('storage/product_image') . '/' . $product->image }}" /></span>
                                <div class="dFlex reviewsSec">
                                    <ul>
                                        @if ($avgRating)
                                            @for ($i = 0; $i < $avgRating; $i++)
                                                <li class="active"><i class="fa fa-star"></i></li>
                                            @endfor
                                            @for ($i = 0; $i < $empty_star; $i++)
                                                <li><i class="fa fa-star"></i></li>
                                            @endfor
                                        @endif
                                    </ul>
                                    <p>{{ $avgRating ? $ratingCountStr : @$product->getBrand->name }}</p>
                                </div>
                                <h3>{{ $product->title }}</h3>
                                <p class="price">${{ number_format($product->selling_offer_price, 2) }} /
                                    <del>${{ number_format($product->selling_price, 2) }}</del>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @include('includes.frontend.testimonial')
@stop

@push('scripts')
    {{-- <script src="{{ asset('assets/js/horizontalvertical.js') }}"></script> --}}
    <script type="text/javascript" src="{{ asset('assets//js/xzoom.min.js') }}"></script>
    <script src="{{ asset('assets//js/setup.js') }}"></script>
    <script src="{{ asset('msg-alert-plugin/dist/js/bootstrap-msg.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(document)
                .on('click', 'form button[type=submit]', function(e) {
                    e.preventDefault(); //prevent the default action

                    //variation validation
                    const varArr = {!! $jsonArr !!};
                    const varcont = varArr.length;
                    for (let i = 0; i < varcont; i++) {
                        if (!$("input[name='variation_combination[" + varArr[i] + "][]']:checked").val()) {
                            Msg.error('Please Select a ' + varArr[i], 4000);
                            return false;
                        }
                    }

                    $("#myform").submit();
                });

            // This button will increment the value
            $('.qtyplus').click(function(e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                fieldName = $(this).attr('field');
                // Get its current value
                var currentVal = parseInt($('input[name=' + fieldName + ']').val());

                //max limited stock
                // maxLimit = parseInt({{ $productDetail->available_quantity }});
                maxLimit = $('#available_quantity').val();
                if (currentVal + 1 == maxLimit) {
                    $(this).addClass('disabled-btn');
                }

                // If is not undefined
                if (!isNaN(currentVal) && currentVal < maxLimit) {
                    $('.qtyminus').removeClass('disabled-btn');
                    // Increment
                    $('input[name=' + fieldName + ']').val(currentVal + 1);
                } else {
                    // Otherwise put a 0 there
                    $('input[name=' + fieldName + ']').val(currentVal);
                    $(this).addClass('disabled-btn');
                }
            });
            // This button will decrement the value till 0
            $(".qtyminus").click(function(e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                fieldName = $(this).attr('field');
                // Get its current value
                var currentVal = parseInt($('input[name=' + fieldName + ']').val());
                if (currentVal - 1 == 1) {
                    $(this).addClass('disabled-btn');
                }
                // If it isn't undefined or its greater than 0
                if (!isNaN(currentVal) && currentVal > 1) {
                    $('.qtyplus').removeClass('disabled-btn');
                    // Decrement one
                    $('input[name=' + fieldName + ']').val(currentVal - 1);
                } else {
                    // Otherwise put a 0 there
                    $('input[name=' + fieldName + ']').val(1);
                    $(this).addClass('disabled-btn');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {

            $('.cartBtn').on('click', function() {

                //variation validation
                const varArr = {!! $jsonArr !!};
                const varcont = varArr.length;
                for (let i = 0; i < varcont; i++) {
                    if (!$("input[name='variation_combination[" + varArr[i] + "][]']:checked").val()) {
                        Msg.error('Please Select a ' + varArr[i], 4000);
                        return false;
                    }
                }

                //add to cart
                $('.mngBtn').removeClass("cartBtn");
                $.ajax({
                    type: 'post',
                    url: '{!! route('add.cart', $productDetail->id) !!}',
                    data: $('#myform').serialize(),
                    beforeSend: function() {
                        $('.mngBtn').text("loading....");
                    },
                    success: function(response) {
                        response = JSON.stringify(response);
                        response = JSON.parse(response);
                        if (response.status == "success") {
                            $('.mngBtn').addClass("cartBtn");
                            $('.cartBtn').text("Add to Bag");
                            $('.count').show();
                            $('.count').text(response.user_cart);
                            $('#available_quantity').val(response.available_quan);
                            $('#quantity').val('1');
                            if (response.available_quan == 0) {
                                $('.smBtn').hide();
                                $('.goCart').show();
                                $('.quantitySec').hide();
                            }
                            Msg.success('Item added to cart', 3000);
                        } else if (response.status == "error") {
                            Msg.error('Unable To Process Your Request', 3000);
                        }
                    }
                });

            });

        });
    </script>
@endpush
