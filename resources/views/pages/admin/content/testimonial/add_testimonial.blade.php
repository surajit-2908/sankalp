@extends('layouts.admin-dashboard')
@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec testimonial-list-sec">
            <div class="category-list-hdn">
                <h2>Add Testimonial</h2>
                <h3 class="create-cat">
                    <a href="{{ route('admin.testimonial') }}">Back</a>
                </h3>
            </div>


            <div class="testimonial-list-area">
                <form action="{{ route('admin.testimonial.insert') }}" method="POST" id="testimonial_form"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" required="">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Designation</label>
                                <input type="text" name="designation" class="form-control" required="">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Comment</label>
                                <textarea class="form-control" name="comment" rows="6" required=""></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Image <small class="text-danger">*Image size must be less than
                                        2MB</small></label>
                                <div class="custom-file mb-3">
                                    <input type="file" class="custom-file-input" name="image" onchange="readURL(this);"
                                        accept="image/*" required>
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 show-img" style="display: none;">
                            <img id="showImg" src="#" alt="your image" />
                        </div>
                    </div>

                    <button class="submit-btn subbtn" type="submit">Submit</button>
                </form>

            </div>
        </div>

    </div>
    <!-- Booking Status Section Start -->
@stop
