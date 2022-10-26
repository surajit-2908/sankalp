@extends('layouts.admin-dashboard')
@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec brand-list-sec">
            <div class="category-list-hdn">
                <h2>Edit Setting</h2>
                <h3 class="create-cat">
                    {{-- <a href="{{ route('admin.brand') }}">Back</a> --}}
                </h3>
            </div>

            <div class="brand-list-area">
                <form action="{{ route('admin.update.settings', $dataArr['settings']->id) }}" method="POST" id="brand_form"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Vat <small class="text-danger">(in %)</small></label>
                                <input type="number" name="vat" class="form-control"
                                    value="{{ $dataArr['settings']->vat }}" min="0" step=".01" required="">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Shipping Charge <small class="text-danger">(in $)</small></label>
                                <input type="number" name="shipping_charge" class="form-control"
                                    value="{{ $dataArr['settings']->shipping_charge }}" min="0" step=".01"
                                    required="">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Refund Charge <small class="text-danger">(in %)</small></label>
                                <input type="number" name="refund_charge" class="form-control"
                                    value="{{ $dataArr['settings']->refund_charge }}" min="0" step=".01"
                                    required="">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6"></div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Contact Email</label>
                                <input type="email" name="contact_email" class="form-control"
                                    value="{{ $dataArr['settings']->contact_email }}" required="">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Contact Phone</label>
                                <input type="text" name="contact_phone" class="form-control"
                                    value="{{ $dataArr['settings']->contact_phone }}" required="">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Contact Address</label>
                                <input type="text" name="contact_address" class="form-control"
                                    value="{{ $dataArr['settings']->contact_address }}" required="">
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
