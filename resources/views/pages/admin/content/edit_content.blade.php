@extends('layouts.admin-dashboard')
@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec testimonial-list-sec">
            <div class="category-list-hdn">
                <h2 style="text-transform: capitalize;">Edit {{ $dataArr['contentArr']->page }} Page Content</h2>
                <h3 class="create-cat">
                    <a href="{{ route('admin.content.listing', $dataArr['contentArr']->page) }}">Back</a>
                </h3>
            </div>
            {{ @$message }}
            <div class="testimonial-list-area">
                <form action="{{ route('admin.content.update', $dataArr['contentArr']->id) }}" method="POST"
                    id="testimonial_form" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        @if (!($dataArr['contentArr']->page == 'home' && $dataArr['contentArr']->position == 'bottom_banner'))
                            @if (!($dataArr['contentArr']->page == 'about' && $dataArr['contentArr']->position == 'middle_banner'))
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" name="title" class="form-control"
                                            value="{{ $dataArr['contentArr']->title }}" required="">
                                    </div>
                                </div>
                            @endif
                        @endif
                        @if (!($dataArr['contentArr']->page == 'contact' && $dataArr['contentArr']->position == 'top_banner'))
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label>Sub Title</label>
                                    <input type="text" name="sub_title" class="form-control"
                                        value="{{ $dataArr['contentArr']->sub_title }}" required="">
                                </div>
                            </div>
                        @endif
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description" rows="6" required="">{!! str_replace('<br />', '', $dataArr['contentArr']->description) !!}</textarea>
                            </div>
                        </div>

                        @if (!($dataArr['contentArr']->page == 'about' && $dataArr['contentArr']->position == 'bottom_banner'))
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label>Image <small class="text-danger">*Image size must be less than
                                            2MB</small></label>
                                    <div class="custom-file mb-3">
                                        <input type="file" class="custom-file-input" name="image"
                                            onchange="readURL(this);" accept="image/*"
                                            @if (!$dataArr['contentArr']->image) required @endif>
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($dataArr['contentArr']->image)
                            <div class="col-lg-12 col-md-12 show-img">
                                <img id="showImg"
                                    src="{{ asset('storage/content_image/') . '/' . $dataArr['contentArr']->image }}">
                            </div>
                        @else
                            <div class="col-lg-12 col-md-12 show-img" style="display: none;">
                                <img id="showImg" src="#" alt="your image" />
                            </div>
                        @endif
                        @if ($dataArr['contentArr']->page == 'home' && $dataArr['contentArr']->position == 'bottom_banner')
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label>Another Image <small class="text-danger">*Image size must be less than
                                            2MB</small></label>
                                    <div class="custom-file mb-3">
                                        <input type="file" class="custom-file-input" name="image2"
                                            onchange="readURLSec(this);" accept="image/*">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            @if ($dataArr['contentArr']->image2)
                                <div class="col-lg-12 col-md-12 show-img2">
                                    <img id="showImg2"
                                        src="{{ asset('storage/content_image/') . '/' . $dataArr['contentArr']->image2 }}">
                                </div>
                            @else
                                <div class="col-lg-12 col-md-12 show-img2" style="display: none;">
                                    <img id="showImg2" src="#" alt="your image" />
                                </div>
                            @endif
                        @endif
                    </div>
                    <button class="submit-btn subbtn" type="submit">Submit</button>
                </form>

            </div>
        </div>

    </div>
    <!-- Booking Status Section Start -->
@stop

@push('scripts')
    <script type="text/javascript">
        function readURLSec(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#showImg2')
                        .attr('src', e.target.result);
                };
                $('.show-img2').show();

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
