@extends('layouts.admin-dashboard')
@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec category-list-sec">
            <div class="category-list-hdn">
                <h2>Category Management</h2>
                <h3 class="create-cat">
                    <a href="{{ route('admin.category.add') }}">Add new Category</a>
                </h3>
            </div>

            <div class="category-list-area" id="showFilter">

                <!-- User List Area -->
                <div class="datatable">
                    <div class="card-body">
                        <table class="table" id="bootstrap-data-table">

                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($dataArr['categoryArr'] as $category)
                                    <tr>
                                        <td title="Name">
                                            {{ $category->name }}
                                        </td>
                                        <td title="Action">
                                            <a href="{{ route('admin.category.edit', $category->id) }}" title="Edit">
                                                <i class="fa fa-edit listing"></i>
                                            </a>
                                            <a href="{{ route('admin.category.remove', $category->id) }}" title="Delete"
                                                class="multi-delete-confirm">
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
