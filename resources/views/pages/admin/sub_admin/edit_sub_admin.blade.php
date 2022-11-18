@extends('layouts.admin-dashboard')
@section('content')
    <div class="dFlx spaceBet">
        <h1 class="pageTitle mb20">Edit Sub Admin</h1>
        <a class="addNew" href="{{ route('admin.sub.admin') }}">Back</a>
    </div>
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec sub-admin-list-sec">



            <div class="sub-admin-list-area">
                <form action="{{ route('admin.sub.admin.update', $dataArr['subAdminArr']->id) }}" method="POST"
                    id="sub_admin_form">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ $dataArr['subAdminArr']->name }}" required="">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="phone" class="form-control"
                                    value="{{ $dataArr['subAdminArr']->phone }}" pattern="[6789][0-9]{9}" required="">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ $dataArr['subAdminArr']->email }}"
                                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required="">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="text" name="password" class="form-control" value="">
                            </div>
                        </div>
                    </div>

                    <button class="submit-btn subBtn" type="submit">Submit</button>
                </form>

            </div>
        </div>

    </div>
    <!-- Booking Status Section Start -->
@stop
