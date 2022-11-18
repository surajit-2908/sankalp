@extends('layouts.admin-dashboard')
@section('content')
    <h1 class="pageTitle mb20">User Log Management</h1>
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec company-list-sec">


            <div class="company-list-area" id="showFilter">

                <!-- User List Area -->
                <div class="datatable table1">
                    <table class="table" id="bootstrap-data-table">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Log</th>
                                <th>DateTime</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($dataArr['userLogArr'] as $userLog)
                                <tr>
                                    <td title="Company Name">
                                        {{ $userLog->getUser->name }}
                                    </td>
                                    <td title="Company Name">
                                        {{ $userLog->log }}
                                    </td>
                                    <td title="DateTime">
                                        {{ date('h:i a, d M Y', strtotime($userLog->created_at)) }}
                                    </td>

                                    <td title="Action">
                                        <a href="{{ route('admin.user.log.remove', $userLog->id) }}" title="Delete"
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
