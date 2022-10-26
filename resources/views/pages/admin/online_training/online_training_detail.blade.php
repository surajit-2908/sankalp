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
                <h2>Online Training Details Of <i class="text-danger">{{ @$dataArr['OnlineTrainingDetail']->title }}</i></h2>
                <h3 class="create-cat">
                    <a href="{{ route('admin.online.training') }}">Back</a>
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
                                                    src="{{ asset('storage/online_training_file/') . '/' . $dataArr['OnlineTrainingDetail']->image }}">
                                            </div>
                                        </div>
                                        <h1>{{ @$dataArr['OnlineTrainingDetail']->title }}</h1>
                                    </div>

                                    <div class="present-field" style="width: 100%;">
                                        <label style="width: 16%;">Sub Title</label>
                                        <span class="show-span">{{ @$dataArr['OnlineTrainingDetail']->sub_title }}</span>
                                    </div>

                                    <div class="present-field">
                                        <label>Hours</label>
                                        <span class="show-span">{{ @$dataArr['OnlineTrainingDetail']->hours }} Hours</span>
                                    </div>

                                    <div class="present-field">
                                        <label>Price</label>
                                        <span
                                            class="show-span">${{ number_format($dataArr['OnlineTrainingDetail']->price, 2) }}</span>
                                    </div>

                                    <div class="present-field">
                                        <label>Selling Price</label>
                                        <span
                                            class="show-span">${{ number_format($dataArr['OnlineTrainingDetail']->selling_price, 2) }}</span>
                                    </div>

                                    <div class="present-field">
                                        <label>Show in Bottom</label>
                                        <span class="show-span">
                                            @if ($dataArr['OnlineTrainingDetail']->bottom_item)
                                                <b class="text-success">Active</b>
                                            @else
                                                <b class="text-danger">Inactive</b>
                                            @endif
                                        </span>
                                    </div>

                                    <div class="present-field" style="width: 100%;">
                                        <label style="width: 16%;">Description</label>
                                        <span class="show-span">{!! @$dataArr['OnlineTrainingDetail']->description !!}</span>
                                    </div>
                                </div>
                            </div>

                            @if ($dataArr['OnlineTrainingDetail']->video)
                                <div class="land-data-col" style="width: 100%; margin-top: 25px;">
                                    <div class="present_prt">
                                        <h2>Video</h2>
                                        <div class="button_prt"></div>

                                        <div class="room-img">
                                            <video width="400" height="250" controls>
                                                <source
                                                    src="{{ asset('storage/online_training_file/') . '/' . $dataArr['OnlineTrainingDetail']->video }}">
                                            </video>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if (count(@$dataArr['OnlineTrainingDetail']->getRatingDetail))
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
                                            @foreach ($dataArr['OnlineTrainingDetail']->getRatingDetail as $key => $getRatingDetail)
                                                <tr class="{{ $key % 2 == 0 ? 'light-color' : 'dark-color' }}">
                                                    <td><a href="{{ route('admin.online.training.order.view', @$getRatingDetail->getOrderDetail->id) }}"
                                                            class="text-info font-weight-bold">#{{ @$getRatingDetail->order_number }}</a>
                                                    </td>
                                                    <td>{{ @$getRatingDetail->getUserDetail->getFullNameAttribute() }}
                                                    </td>
                                                    <td>{{ @$getRatingDetail->rating }}</td>
                                                    <td>{{ @$getRatingDetail->title ? $getRatingDetail->title : '' }}
                                                    </td>
                                                    <td>{{ @$getRatingDetail->description }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.online.training.rating.remove', $getRatingDetail->id) }}"
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
