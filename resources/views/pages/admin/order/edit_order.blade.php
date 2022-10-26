@extends('layouts.admin-dashboard')
@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec brand-list-sec">
            <div class="category-list-hdn">
                <h2>Edit Brand</h2>
                <h3 class="create-cat">
                    <a href="{{ route('admin.brand') }}">Back</a>
                </h3>
            </div>

            <div class="brand-list-area">
                <form action="{{ route('admin.brand.update', $dataArr['brandArr']->id) }}" method="POST"
                    id="brand_form" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ $dataArr['brandArr']->name }}" required="">
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
