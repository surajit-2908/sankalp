@extends('layouts.admin-dashboard')
@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec variation-list-sec">
            <div class="category-list-hdn">
                <h2>Online Training Management</h2>
                <h3 class="create-cat">
                    <a href="{{ route('admin.online.training.add') }}">Add new Online Training</a>
                </h3>
            </div>

            <div class="variation-list-area" id="showFilter">

                <!-- User List Area -->
                <div class="datatable">
                    <div class="card-body">
                        <table class="table" id="bootstrap-data-table">

                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Sub Title</th>
                                    <th>Image</th>
                                    <th>Video</th>
                                    <th>Hours</th>
                                    <th>Price</th>
                                    <th>Selling Price</th>
                                    <th>Show in Bottom</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($dataArr['onlineTrainingArr'] as $onlineTraining)
                                    <tr>
                                        <td title="Title">
                                            {{ $onlineTraining->title }}
                                        </td>
                                        <td title="Sub Title">
                                            {{ $onlineTraining->sub_title }}
                                        </td>
                                        <td title="Image">
                                            <img src="{{ asset('storage/online_training_file') . '/' . $onlineTraining->image }}"
                                                alt="" class="bnr-img">
                                        </td>
                                        <td title="Video">
                                            {{-- <iframe
                                                src="https://www.youtube.com/embed/{{ $onlineTraining->youtube_video_id }}">
                                            </iframe> --}}
                                            @if ($onlineTraining->video)
                                                <video width="250" height="150" controls>
                                                    <source
                                                        src="{{ asset('storage/online_training_file/') . '/' . $onlineTraining->video }}">
                                                </video>
                                            @else
                                                ----------
                                            @endif
                                        </td>
                                        <td title="Hours">
                                            {{ $onlineTraining->hours }}
                                        </td>
                                        <td title="Price">
                                            ${{ number_format($onlineTraining->price, 2) }}
                                        </td>
                                        <td title="Selling Price">
                                            ${{ number_format($onlineTraining->selling_price, 2) }}
                                        </td>
                                        <td title="Show in Bottom">
                                            <a href="{{ route('admin.online.training.bottom.status', $onlineTraining->id) }}"
                                                title="Change Show in Bottom Status" class="status-confirm">
                                                @if ($onlineTraining->bottom_item)
                                                    <i class="fa fa-check text-success"></i>
                                                    Active
                                                @else
                                                    <i class="fa fa-times text-danger"></i>
                                                    Inactive
                                                @endif
                                            </a>
                                        </td>
                                        <td title="Action">
                                            <div class="doted-dropdown">
                                                <p>...</p>
                                                <div class="doted-dropdown-content">
                                                    <a href="{{ route('admin.online.training.detail', $onlineTraining->id) }}"
                                                        title="Online Training Details">
                                                        <i class="fa fa-eye views"></i>
                                                    </a>
                                                    <a href="{{ route('admin.online.training.edit', $onlineTraining->id) }}"
                                                        title="Edit">
                                                        <i class="fa fa-edit listing"></i>
                                                    </a>
                                                    <a href="{{ route('admin.online.training.remove', $onlineTraining->id) }}"
                                                        title="Delete" class="delete-confirm">
                                                        <i class="fa fa-trash chat"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
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
