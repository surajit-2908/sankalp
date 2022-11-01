@extends('layouts.admin-dashboard')
@section('content')
    <h1 class="pageTitle mb20">Enquiry Management</h1>
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
                                <th>Company Name</th>
                                <th>Key Person</th>
                                <th>Email</th>
                                <th>Country</th>
                                <th>Phone</th>
                                <th>Industry</th>
                                <th>Enquiry Status</th>
                                <th>Order Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($dataArr['enquiryArr'] as $enquiry)
                                <tr>
                                    <td title="Company Name">
                                        {{ $enquiry->company_name }}
                                    </td>
                                    <td title="Key Person">
                                        {{ $enquiry->key_person }}
                                    </td>
                                    <td title="Email">
                                        {{ $enquiry->email }}
                                    </td>
                                    <td title="Country">
                                        {{ $enquiry->country }}
                                    </td>
                                    <td title="Phone">
                                        {{ $enquiry->phone }}
                                    </td>
                                    <td title="Industry">
                                        {{ $enquiry->industry }}
                                    </td>
                                    <td title="Enquiry Status">
                                        <a href="{{ route('admin.enquiry.status', [$enquiry->id, 'enquiry_status']) }}"
                                            title="Enquiry Status" class="status-confirm">
                                            @if ($enquiry->enquiry_status)
                                                <i class="fa fa-toggle-on chat"></i>
                                            @else
                                                <i class="fa fa-toggle-off chat"></i>
                                            @endif
                                        </a>
                                    </td>
                                    <td title="Order Status">
                                        <a href="{{ route('admin.enquiry.status', [$enquiry->id, 'order_status']) }}"
                                            title="Order Status" class="status-confirm">
                                            @if ($enquiry->order_status)
                                                <i class="fa fa-toggle-on chat"></i>
                                            @else
                                                <i class="fa fa-toggle-off chat"></i>
                                            @endif
                                        </a>
                                    </td>
                                    <td title="Action">
                                        <a href="{{ route('admin.enquiry.view', $enquiry->id) }}" title="View">
                                            <i class="fa fa-eye chat"></i>
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
