@extends('layouts.admin-dashboard')
@section('content')
    <div class="dFlx spaceBet">
        <h1 class="pageTitle mb20">User Log Of Order <i>#{{ $dataArr['order']->invoice_number }}</i></h1>
        <a class="addNew" href="{{ route('admin.order') }}">Back</a>
    </div>
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
                                @php
                                    $user_log = str_replace('Order with invoice number: ' . $dataArr['order']->invoice_number . '.. ', '', $userLog->log);
                                @endphp
                                <tr>
                                    <td title="User">
                                        {{ $userLog->getUser->name }}
                                    </td>
                                    <td title="Log">
                                        {{ ucfirst($user_log) }}
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
