@extends('layouts.admin-dashboard')
@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec testimonial-list-sec">
            <div class="category-list-hdn">
                <h2>Content Management</h2>
                <h3 class="create-cat">
                    {{-- <a href="{{ route('admin.testimonial.add') }}">Add new Testimonial</a> --}}
                </h3>
            </div>

            <div class="testimonial-list-area" id="showFilter">

                <!-- User List Area -->
                <div class="datatable">
                    <div class="card-body">
                        <table class="table" id="bootstrap-data-table">

                            <thead>
                                <tr>
                                    <th>Page / Section</th>
                                    <th>Manage</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td title="Page / Section">Testimonial</td>
                                    <td title="Manage">
                                        <a href="{{ route('admin.testimonial') }}" title="Mange">
                                            <i class="fa fa-external-link views"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td title="Page / Section">Home Page</td>
                                    <td title="Manage">
                                        <a href="{{ route('admin.content.listing', 'home') }}" title="Mange">
                                            <i class="fa fa-external-link views"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td title="Page / Section">About Page</td>
                                    <td title="Manage">
                                        <a href="{{ route('admin.content.listing', 'about') }}" title="Mange">
                                            <i class="fa fa-external-link views"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td title="Page / Section">Contact Page</td>
                                    <td title="Manage">
                                        <a href="{{ route('admin.content.listing', 'contact') }}" title="Mange">
                                            <i class="fa fa-external-link views"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Booking Status Section Start -->
@stop
