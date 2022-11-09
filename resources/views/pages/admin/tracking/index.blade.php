@extends('layouts.admin-dashboard')
@section('content')
    <h1 class="pageTitle mb20">Tracking Management</h1>
    {{-- <a class="addNew" href="{{ route('admin.enquiry.add') }}"><i class="fa fa-plus"></i> Add New Enquiry</a> --}}
    <br />
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec enquiry-list-sec">


            <div class="enquiry-list-area" id="showFilter">

                <!-- User List Area -->
                <div class="datatable table1">
                    <table class="table" id="bootstrap-data-table">
                        <thead>
                            <tr>
                                <th>Invoice Number</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($dataArr['trackingArr'] as $tracking)
                                <tr>
                                    <td title="Invoice Number">
                                        <b>#{{ $tracking->invoice_number }}</b>
                                    </td>
                                    <td title="Email">
                                        {{ $tracking->email }}
                                    </td>
                                    <td title="Action">
                                        <a href="{{ route('admin.tracking.remove', $tracking->id) }}" title="Delete" class="delete-confirm">
                                            <i class="fa fa-trash"></i>
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
