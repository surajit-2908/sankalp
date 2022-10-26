@extends('layouts.admin-dashboard')
@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec variation-list-sec">
            <div class="category-list-hdn">
                <h2>Edit Variation Option</h2>
                <h3 class="create-cat">
                    <a href="{{ route('admin.variation.option') }}">Back</a>
                </h3>
            </div>

            <div class="variation-list-area">
                <form action="{{ route('admin.variation.option.update', $dataArr['VariationOptionArr']->id) }}" method="POST"
                    id="variation_form" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>variation</label>
                                <select class="form-control" name="variation_id" required="">
                                    <option value="0">Select Variation</option>
                                    @foreach ($dataArr['variationArr'] as $variation)
                                        <option value="{{ $variation->id }}" {{ $variation->id == $dataArr['VariationOptionArr']->variation_id ? 'selected' : '' }}>{{ $variation->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ $dataArr['VariationOptionArr']->name }}" required="">
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
