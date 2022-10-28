@extends('layouts.admin-dashboard')
@section('content')
    <h1 class="pageTitle mb20">Company Management</h1>
    <a class="addNew" href="{{ route('admin.company.add') }}"><i class="fa fa-plus"></i> Add New Company</a>
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec company-list-sec">


            <div class="company-list-area" id="showFilter">

                <!-- User List Area -->
                <div class="datatable table1">
                    <table class="table" id="bootstrap-data-table">
                        <thead>
                            <tr>
                                <th>Company Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($dataArr['companyArr'] as $company)
                                <tr>
                                    <td title="Company Name">
                                        {{ $company->company_name }}
                                    </td>
                                    <td title="Action">
                                        <a href="{{ route('admin.company.edit', $company->id) }}" title="Edit">
                                            <i class="fa fa-edit listing"></i>
                                        </a>
                                        <a href="{{ route('admin.company.remove', $company->id) }}" title="Delete"
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
