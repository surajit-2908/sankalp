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
    <div class="dFlx spaceBet">
        <h1 class="pageTitle mb20">Product Details Of <i class="text-danger">{{ @$dataArr['productDetail']->title }}</i></h1>
        <a class="addNew" href="{{ route('admin.product') }}">Back</a>
    </div>
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec category-list-sec">

            <div class="category-list-area" id="showFilter">

                <div class="datatable">
                    <div class="card-body pro-describe">
                        <div class="land-data-sec presentContent">
                            <div class="land-data-col" style="width: 100%; margin-bottom: 15px;">
                                <div class="present_prt">
                                    <div class="button_prt"></div>

                                    <div class="present-field">
                                        <label>Title</label>
                                        <span class="show-span">{{ @$dataArr['productDetail']->title }}</span>
                                    </div>

                                    <div class="present-field">
                                        <label>Category</label>
                                        <span class="show-span">{{ @$dataArr['productDetail']->getCat->name }}</span>
                                    </div>

                                    @if (@$dataArr['productDetail']->getSubCat->name)
                                        <div class="present-field">
                                            <label>Sub Category</label>
                                            <span class="show-span">{{ @$dataArr['productDetail']->getSubCat->name }}</span>
                                        </div>
                                    @endif

                                    {{-- <div class="present-field">
                                        <label>Quantity</label>
                                        <span class="show-span">{{ @$dataArr['productDetail']->quantity }}</span>
                                    </div>

                                    <div class="present-field">
                                        <label>Product Price</label>
                                        <span
                                            class="show-span">${{ number_format($dataArr['productDetail']->selling_price, 2) }}</span>
                                    </div>

                                    <div class="present-field">
                                        <label>Selling Price</label>
                                        <span
                                            class="show-span">${{ number_format($dataArr['productDetail']->selling_offer_price, 2) }}</span>
                                    </div> --}}

                                    <div class="present-field">
                                        <label>Status</label>
                                        <span class="show-span">
                                            @if ($dataArr['productDetail']->status)
                                                <b class="text-success">Active</b>
                                            @else
                                                <b class="text-danger">Inactive</b>
                                            @endif
                                        </span>
                                    </div>

                                    <div class="present-field" style="width: 100%;">
                                        <label style="width: 16%;">Description</label>
                                        <span class="show-span">{!! @$dataArr['productDetail']->description !!}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="land-data-col" style="width: 100%; margin-top: 25px;">
                                <div class="present_prt">
                                    <h2 style="margin-bottom: 25px;">Gallery Images</h2>

                                    <div class="room-img">
                                        @foreach ($dataArr['productDetail']->getImages as $img)
                                            <div>
                                                <img src="{{ asset('storage/product_image/') . '/' . $img->image_name }}">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

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
