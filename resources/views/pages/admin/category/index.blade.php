@extends('layouts.admin-dashboard')
@section('content')
    <h1 class="pageTitle mb20">Category Management</h1>
    <a class="addNew" href="{{ route('admin.category.add') }}"><i class="fa fa-plus"></i> Add New Category</a>

    <div class="admin-body-area">

        <div class="booking-status-sec company-list-sec">
            <div class="category-list-area" id="showFilter">

                <!-- User List Area -->
                <div class="datatable table1">
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

@stop
