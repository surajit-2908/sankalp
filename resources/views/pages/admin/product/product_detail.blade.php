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
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec category-list-sec">
            <div class="category-list-hdn">
                <h2>Product Details Of <i class="text-danger">{{ @$dataArr['productDetail']->title }}</i></h2>
                <h3 class="create-cat">
                    <a href="{{ route('admin.product') }}">Back</a>
                </h3>
            </div>

            <div class="category-list-area" id="showFilter">

                <div class="datatable">
                    <div class="card-body pro-describe">
                        <div class="land-data-sec presentContent">
                            <div class="land-data-col" style="width: 100%; margin-bottom: 15px;">
                                <div class="present_prt">
                                    <div class="button_prt"></div>

                                    <div class="present-field" style="width: 100%; background-color:#fff;">
                                        <div class="room-img">
                                            <div>
                                                <img
                                                    src="{{ asset('storage/product_image/') . '/' . $dataArr['productDetail']->image }}">
                                            </div>
                                        </div>
                                        <h1>{{ @$dataArr['productDetail']->title }}</h1>
                                    </div>

                                    <div class="present-field">
                                        <label>Brand</label>
                                        <span class="show-span">{{ @$dataArr['productDetail']->getBrand->name }}</span>
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

                                    <div class="present-field">
                                        <label>Available Quantity</label>
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
                                    </div>

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

                                    <div class="present-field">
                                        <label>Featured Status</label>
                                        <span class="show-span">
                                            @if ($dataArr['productDetail']->featured)
                                                <b class="text-success">Active</b>
                                            @else
                                                <b class="text-danger">Inactive</b>
                                            @endif
                                        </span>
                                    </div>

                                    <div class="present-field" style="width: 100%;">
                                        <label style="width: 16%;">Description</label>
                                        <span class="show-span">{!! @$dataArr['productDetail']->long_description !!}</span>
                                    </div>

                                    <div class="present-field" style="width: 100%;">
                                        <label style="width: 16%;">Features</label>
                                        <span class="show-span">{!! $dataArr['productDetail']->feautres !!}
                                        </span>
                                    </div>

                                    <div class="present-field" style="width: 100%;">
                                        <label style="width: 16%;">Shipping & Returns</label>
                                        <span class="show-span">{!! @$dataArr['productDetail']->shopping_returns !!}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="land-data-col" style="width: 100%; margin-top: 25px;">
                                <div class="present_prt">
                                    <h2>Gallery Images</h2>
                                    <div class="button_prt"></div>

                                    <div class="room-img">
                                        @foreach ($dataArr['productDetail']->getImages as $img)
                                            <div>
                                                <img src="{{ asset('storage/product_image/') . '/' . $img->image_name }}">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            @if (count(@$dataArr['productDetail']->getRatingReview))
                                <div class="land-data-col" style="width: 100%; margin-top: 25px;">
                                    <div class="present_prt">
                                        <h2>Ratings & Reviews</h2>
                                        <div class="button_prt"></div>

                                        <table>
                                            <tr align="center">
                                                <th>Order Number</th>
                                                <th>User</th>
                                                <th>Rating</th>
                                                <th>Review Title</th>
                                                <th>Review Description</th>
                                                <th>Action</th>
                                            </tr>
                                            @foreach ($dataArr['productDetail']->getRatingReview as $key => $getRatingReview)
                                                <tr class="{{ $key % 2 == 0 ? 'light-color' : 'dark-color' }}">
                                                    <td><a
                                                            href="{{ route('admin.order.view', @$getRatingReview->getOrderDetail->id) }}" class="text-info font-weight-bold">#{{ @$getRatingReview->order_number }}</a>
                                                    </td>
                                                    <td>{{ @$getRatingReview->getUserDetail->getFullNameAttribute() }}
                                                    </td>
                                                    <td>{{ @$getRatingReview->rating }}</td>
                                                    <td>{{ @$getRatingReview->title ? $getRatingReview->title : '' }}
                                                    </td>
                                                    <td>{{ @$getRatingReview->description }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.product.rating.remove', $getRatingReview->id) }}"
                                                            title="Delete" class="delete-confirm">
                                                            <i class="fa fa-trash chat"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>

                                    </div>
                                </div>
                            @endif

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
