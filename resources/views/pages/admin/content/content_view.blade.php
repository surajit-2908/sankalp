@extends('layouts.admin-dashboard')
@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec testimonial-list-sec">
            <div class="category-list-hdn">
                <h2 style="text-transform: capitalize;">{{ $dataArr['page'] }} page Content Management</h2>
                <h3 class="create-cat">
                    <a href="{{ route('admin.content') }}">Back</a>
                </h3>
            </div>

            <div class="testimonial-list-area" id="showFilter">

                <!-- User List Area -->
                <div class="datatable">
                    <div class="card-body">
                        <table class="table" id="bootstrap-data-table">

                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Sub Title</th>
                                    <th>Position</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($dataArr['contentArr'] as $content)
                                    <tr>
                                        <td title="Image">
                                            @if ($content->image)
                                                <img src="{{ asset('storage/content_image') . '/' . $content->image }}"
                                                    alt="" class="bnr-img">
                                            @else
                                                -----
                                            @endif
                                        </td>
                                        <td title="Title">{{ $content->title ? $content->title : '----' }}</td>
                                        <td title="Sub Title">{{ $content->sub_title ? $content->sub_title : '----' }}</td>
                                        <td title="Position">
                                            {{ $content->position == 'top_banner' ? 'Top Banner' : ($content->position == 'middle_banner' ? 'Middle Banner' : 'Bottom Banner') }}
                                        </td>
                                        <td title="Manage">
                                            <a href="{{ route('admin.content.edit', $content->id) }}" title="Edit">
                                                <i class="fa fa-edit listing"></i>
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

    </div>
    <!-- Booking Status Section Start -->
@stop
