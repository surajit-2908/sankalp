@extends('layouts.admin-dashboard')
@section('content')
    <h1 class="pageTitle mb20">Sub Admin Management</h1>
    <a class="addNew" href="{{ route('admin.sub.admin.add') }}"><i class="fa fa-plus"></i> Add New Sub Admin</a>
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec sub-admin-list-sec">


            <div class="sub-admin-list-area" id="showFilter">

                <!-- User List Area -->
                <div class="datatable table1">
                    <table class="table" id="bootstrap-data-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($dataArr['subAdminArr'] as $subAdmin)
                                <tr>
                                    <td title="Name">
                                        {{ $subAdmin->name }}
                                    </td>
                                    <td title="Phone">
                                        {{ $subAdmin->phone }}
                                    </td>
                                    <td title="Email">
                                        {{ $subAdmin->email }}
                                    </td>
                                    <td title="Action">
                                        <a href="{{ route('admin.sub.admin.edit', $subAdmin->id) }}" title="Edit">
                                            <i class="fa fa-edit listing"></i>
                                        </a>
                                        <a href="{{ route('admin.sub.admin.remove', $subAdmin->id) }}" title="Delete"
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
    <!-- Booking Status Section Start -->
@stop
