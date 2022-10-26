@extends('layouts.admin-dashboard')
@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec brand-list-sec">
            <div class="category-list-hdn">
                <h2>Brand Management</h2>
                <h3 class="create-cat">
                    <a href="{{ route('admin.brand.add') }}">Add new brand</a>
                </h3>
            </div>

            <div class="brand-list-area" id="showFilter">

                <!-- User List Area -->
                <div class="datatable">
                    <div class="card-body">
                        <table class="table" id="bootstrap-data-table">

                            <thead>
                                <tr>
                                    <th>Brand Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($dataArr['brandArr'] as $brand)
                                    <tr>
                                        <td title="Brand Name">
                                            {{ $brand->name }}
                                        </td>
                                        <td title="Action">
                                            <a href="{{ route('admin.brand.edit', $brand->id) }}" title="Edit">
                                                <i class="fa fa-edit listing"></i>
                                            </a>
                                            <a href="{{ route('admin.brand.remove', $brand->id) }}" title="Delete"
                                                class="delete-confirm">
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
