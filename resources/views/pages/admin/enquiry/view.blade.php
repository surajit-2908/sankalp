@extends('layouts.admin-dashboard')
@section('content')
    <div class="dFlx spaceBet">
        <h1 class="pageTitle mb20">Enquiry Management</h1>
        <a class="addNew" href="{{ route('admin.enquiry') }}">Back</a>
    </div>
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec enquiry-list-sec">


            <div class="enquiry-list-area" id="showFilter">

                <div class="datatable">
                    <div class="pro-describe">
                        <div class="land-data-sec presentContent">
                            <div class="land-data-col" style="width: 100%; margin-bottom: 15px;">
                                <div class="present_prt">

                                    <div class="present-field">
                                        <label>Company Name</label>
                                        <span class="show-span">{{ @$dataArr['enquiryArr']->company_name }}</span>
                                    </div>

                                    <div class="present-field">
                                        <label>Key Person</label>
                                        <span class="show-span">{{ @$dataArr['enquiryArr']->key_person }}</span>
                                    </div>

                                    <div class="present-field">
                                        <label>Email</label>
                                        <span class="show-span">{{ @$dataArr['enquiryArr']->email }}</span>
                                    </div>

                                    <div class="present-field">
                                        <label>Country</label>
                                        <span class="show-span">{{ @$dataArr['enquiryArr']->country }}</span>
                                    </div>

                                    <div class="present-field">
                                        <label>Phone</label>
                                        <span class="show-span">{{ @$dataArr['enquiryArr']->phone }}</span>
                                    </div>

                                    <div class="present-field">
                                        <label>Industry</label>
                                        <span class="show-span">{{ @$dataArr['enquiryArr']->industry }}</span>
                                    </div>

                                    <div class="present-field">
                                        <label>Enquiry Status</label>
                                        <span class="show-span">
                                            @if ($dataArr['enquiryArr']->enquiry_status)
                                                <b class="text-success">Active</b>
                                            @else
                                                <b class="text-danger">Inactive</b>
                                            @endif
                                        </span>
                                    </div>

                                    <div class="present-field">
                                        <label>Order Status</label>
                                        <span class="show-span">
                                            @if ($dataArr['enquiryArr']->order_status)
                                                <b class="text-success">Active</b>
                                            @else
                                                <b class="text-danger">Inactive</b>
                                            @endif
                                        </span>
                                    </div>

                                    <div class="present-field" style="width: 100%;">
                                        <label style="width: 22%;">Enquiry</label>
                                        <span class="show-span">{{ @$dataArr['enquiryArr']->enquiry }}</span>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Booking Status Section Start -->
@stop
