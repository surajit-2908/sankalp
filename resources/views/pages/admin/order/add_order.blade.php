@extends('layouts.admin-dashboard')
@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec order-list-sec">
            <div class="category-list-hdn">
                <h2>Add Order</h2>
                <h3 class="create-cat">
                    <a href="{{ route('admin.order') }}">Back</a>
                </h3>
            </div>


            <div class="order-list-area">
                <form action="{{ route('admin.order.insert') }}" method="POST" id="order_form" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Invoice Number</label>
                                <input type="text" name="invoice_number" class="form-control" required="">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Company Name</label>
                                <select name="company_name" class="form-control" required="">
                                    <option value="">Select Company Name</option>
                                    @foreach ($dataArr['companyName'] as $companyName)
                                        <option value="{{ $companyName->id }}">{{ $companyName->company_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <button class="submit-btn subbtn" type="submit">Submit</button>
                </form>

            </div>
        </div>

    </div>
    <!-- Booking Status Section Start -->
@stop
