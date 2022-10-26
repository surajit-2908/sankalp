@extends('layouts.admin-dashboard')
@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec variation-list-sec">
            <div class="category-list-hdn">
                <h2>Edit Online Training</h2>
                <h3 class="create-cat">
                    <a href="{{ route('admin.online.training') }}">Back</a>
                </h3>
            </div>

            <div class="variation-list-area">
                <form action="{{ route('admin.online.training.update', $dataArr['onlineTrainingArr']->id) }}" method="POST"
                    id="online_trainig_form" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control"
                                    value="{{ $dataArr['onlineTrainingArr']->title }}" required="">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Sub title</label>
                                <input type="text" name="sub_title" class="form-control"
                                    value="{{ $dataArr['onlineTrainingArr']->sub_title }}" required="">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Hours</label>
                                <input type="number" name="hours" class="form-control"
                                    value="{{ $dataArr['onlineTrainingArr']->hours }}" required="">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Price</label>
                                <input type="number" name="price" class="form-control"
                                    value="{{ $dataArr['onlineTrainingArr']->price }}" min="0" step=".01"
                                    required="">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Selling Price</label>
                                <input type="number" name="selling_price" class="form-control"
                                    value="{{ $dataArr['onlineTrainingArr']->selling_price }}" min="0"
                                    step=".01" required="">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description" rows="6" required="">{{ $dataArr['onlineTrainingArr']->description }}</textarea>
                            </div>
                        </div>
                        {{-- <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Youtube Url</label>
                                <input type="text" name="youtube_url" class="form-control"
                                    value="{{ $dataArr['onlineTrainingArr']->youtube_url }}" required="">
                            </div>
                            <span class="text-danger err" style="display: none;">Must be a valid Youtube URL.</span>
                        </div> --}}
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Image <small class="text-danger">*Image size must be less than 2MB</small></label>
                                <div class="custom-file mb-3">
                                    <input type="file" class="custom-file-input" id="gallery-photo-add" name="image"
                                        onchange="readURL(this);" accept="image/*">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6"></div>
                        <div class="col-lg-12 col-md-12 show-img">
                            <img id="showImg"
                                src="{{ asset('storage/online_training_file/') . '/' . $dataArr['onlineTrainingArr']->image }}"
                                style="height100px; width:100px;">
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Video <small class="text-danger">*Video size must be less than 2MB</small></label>
                                <div class="custom-file mb-3">
                                    <input type="file" class="custom-file-input" name="video" id="video-add"
                                        accept=" video/*">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6"></div>
                        <div class="col-lg-12 col-md-12 gallery">
                            @if ($dataArr['onlineTrainingArr']->video)
                                <video width="300" height="200" controls>
                                    <source
                                        src="{{ asset('storage/online_training_file/') . '/' . $dataArr['onlineTrainingArr']->video }}">
                                </video>
                            @endif
                        </div>
                    </div>
                    <button class="submit-btn subbtn" type="submit">Submit</button>
                </form>

            </div>
        </div>

    </div>
    <!-- Booking Status Section Start -->
@stop

@push('script')
    <script type="text/javascript">
        $(function() {
            // Multiple images preview in browser
            var imagesPreview = function(input, placeToInsertImagePreview) {

                if (input.files) {
                    var filesAmount = input.files.length;

                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();

                        reader.onload = function(event) {
                            // var new_html = '<img src="'+event.target.result+'">';
                            var new_html = '<video width="300" height="200" controls><source src="' + event
                                .target.result + '"></video>';
                            $('.gallery').append(new_html);
                            // $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                        }

                        reader.readAsDataURL(input.files[i]);
                    }
                }

            };

            $('#video-add').on('change', function() {
                imagesPreview(this, 'div.gallery');
                $('.gallery').html('');
            });
        });

        $(document).ready(function() {
            $('#galleryForm').click(function() {
                tinymce.triggerSave();
            });
        });
    </script>
@endpush
