@extends('layouts.admin-dashboard')
@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec category-list-sec">
            <div class="category-list-hdn">
                <h2>User Management</h2>
                <h3 class="create-cat">
                    {{-- <a href="{{ route('admin.user.add') }}">Add new user</a> --}}
                </h3>
            </div>

            <div class="category-list-area" id="showFilter">

                <!-- User List Area -->
                <div class="datatable">
                    <div class="card-body">
                        <table class="table" id="bootstrap-data-table">

                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($dataArr['userArr'] as $user)
                                    <tr>
                                        <td title="Name">
                                            {{ $user->fname . ' ' . $user->lname}}
                                        </td>
                                        <td title="Email">
                                            {{ $user->email }}
                                        </td>
                                        <td title="Status">
                                            <a href="{{ route('admin.user.status', $user->id) }}" title="Change Status"
                                                class="status-confirm">
                                                @if ($user->status)
                                                    <i class="fa fa-check text-success"></i>
                                                    Active
                                                @else
                                                    <i class="fa fa-times text-danger"></i>
                                                    Inactive
                                                @endif
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
