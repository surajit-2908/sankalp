@extends('layouts.admin-dashboard')
@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec category-list-sec">
            <div class="category-list-hdn">
                <h2>Feedback Management</h2>
            </div>

            <div class="category-list-area">

                <!-- User List Area -->
                <div class="datatable">
                    <div class="card-body">
                        <table class="table" id="bootstrap-data-table">

                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Message</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($dataArr['feedbackArr'] as $feedback)
                                    <tr>
                                        <td title="Name">
                                            {{ @$feedback->name }}
                                        </td>
                                        <td title="Email">
                                            {{ @$feedback->email }}
                                        </td>
                                        <td title="Phone">
                                            {{ @$feedback->phone }}
                                        </td>
                                        <td title="Message">
                                            {{ @$feedback->msg }}
                                        </td>
                                        <td title="Action">
                                            <a href="{{ route('admin.feedback.remove', $feedback->id) }}" title="Delete"
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

    </div>
    <!-- Booking Status Section Start -->
@stop
