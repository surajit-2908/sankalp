@extends('layouts.admin-dashboard')
@section('content')
    <h1 class="pageTitle">Dashboard</h1>
    <div class="dFlx spaceBet">
        <div class="dashFourClm">
            <h2>I’m new to Sankalp</h2>
            <p>New here? Welcome! The absolute best way to get started is by selecting your Industry from the options
                below.</p>
        </div>
        <div class="dashFourClm">
            <h2>I’m looking for new products</h2>
            <p>You are in the right place then. We update our product portfolio regularly.</p>
        </div>
        <div class="dashFourClm">
            <h2>I want to see Housings </h2>
            <p>Just Click and go through the various housing options we have to offer.</p>
        </div>
        <div class="dashFourClm">
            <h2>I need help with my filters</h2>
            <p>Easily find the answers you need for running your production smoothly.</p>
        </div>
    </div>

    <div class="dashDataTable">
        <div class="datatable table1">
            <table class="table" id="bootstrap-data-table">
                <thead>
                    <tr>
                        <th>Company Name</th>
                        <th>Key Person</th>
                        <th>Email</th>
                        <th>Country</th>
                        <th>Phone</th>
                        {{-- <th>Industry</th> --}}
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
                            {{-- <td title="Industry">
                                {{ $enquiry->industry }}
                            </td> --}}
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
@stop
