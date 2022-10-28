@extends('layouts.admin-dashboard')
@section('content')
    <div class="dFlx spaceBet">
        <h1 class="pageTitle mb20">Edit company</h1>
        <a class="addNew" href="{{ route('admin.company') }}">Back</a>
    </div>
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec company-list-sec">



            <div class="company-list-area">
                <form action="{{ route('admin.company.update', $dataArr['companyArr']->id) }}" method="POST"
                    id="company_form">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Company Name</label>
                                <input type="text" name="company_name" class="form-control"
                                    value="{{ $dataArr['companyArr']->company_name }}" required="">
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
