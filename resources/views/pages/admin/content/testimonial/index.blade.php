@extends('layouts.admin-dashboard')
@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec testimonial-list-sec">
            <div class="category-list-hdn">
                <h2>Testimonial Management</h2>
                <h3 class="create-cat">
                    <a href="{{ route('admin.testimonial.add') }}">Add new Testimonial</a>
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
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($dataArr['testimonialArr'] as $testimonial)
                                    <tr>
                                        <td title="Image">
                                            <img src="{{ asset('storage/testimonial_image') . '/' . $testimonial->image }}"
                                                alt="" class="bnr-img">
                                        </td>
                                        <td title="Name">
                                            {{ $testimonial->name }}
                                        </td>
                                        <td title="Designation">
                                            {{ $testimonial->designation }}
                                        </td>
                                        <td title="Action">
                                            <a href="{{ route('admin.testimonial.edit', $testimonial->id) }}"
                                                title="Edit">
                                                <i class="fa fa-edit listing"></i>
                                            </a>
                                            <a href="{{ route('admin.testimonial.remove', $testimonial->id) }}"
                                                title="Delete" class="delete-confirm">
                                                <i class="fa fa-trash chat"></i>
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
