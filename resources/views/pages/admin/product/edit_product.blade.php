@extends('layouts.admin-dashboard')
@section('content')
    <div class="dFlx spaceBet">
        <h1 class="pageTitle mb20">Edit Product</h1>
        <a class="addNew" href="{{ route('admin.product') }}">Back</a>
    </div>
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec category-list-sec">

            <div class="product-msg" style="display: none;">
                <p class="alert alert-success"><strong>Image Removed Successfully</strong></p>
            </div>
            <div class="product-msg-err" style="display: none;">
                <p class="alert alert-danger"><strong>Unable To Process Your Request</strong></p>
            </div>
            <div class="category-list-area">
                <form action="{{ route('admin.product.update', $dataArr['productArr']->id) }}" method="POST"
                    id="productForm" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control"
                                    value="{{ $dataArr['productArr']->title }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Category
                                </label>
                                <select class="form-control" name="cat_id" id="cat_id" required="">
                                    <option value="">Select Category</option>
                                    @foreach ($dataArr['parentCategoryArr'] as $pCat)
                                        <option value="{{ $pCat->id }}"
                                            {{ $pCat->id == $dataArr['productArr']->cat_id ? ' selected="selected"' : '' }}>
                                            {{ $pCat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Sub-Category
                                </label>
                                <select class="form-control" name="sub_cat_id" id="sub_cat_id"
                                    @if (count($dataArr['subCategoryArr'])) required @endif>
                                    <option value="">Select Sub-Category</option>
                                    @foreach ($dataArr['subCategoryArr'] as $sub_Cat)
                                        <option value="{{ $sub_Cat->id }}"
                                            {{ $sub_Cat->id == $dataArr['productArr']->sub_cat_id ? ' selected="selected"' : '' }}>
                                            {{ $sub_Cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Youtube V-Link</label>
                                <input type="text" name="youtube_link" class="form-control"
                                    value="{{ $dataArr['productArr']->youtube_link }}" required>
                            </div>
                        </div>
                        {{-- <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Available Quantity</label>
                                <input type="number" name="quantity" class="form-control" min="0"
                                    value="{{ $dataArr['productArr']->quantity }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Product Price</label>
                                <input type="number" name="selling_price" class="form-control" min="0"
                                    step=".01" value="{{ $dataArr['productArr']->selling_price }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Selling Price</label>
                                <input type="number" name="selling_offer_price" class="form-control" min="0"
                                    step=".01" value="{{ $dataArr['productArr']->selling_offer_price }}" required>
                            </div>
                        </div> --}}
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description" id="description" rows="6" required="">{!! str_replace('<br />', '', $dataArr['productArr']->description) !!}</textarea>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Operation</label>
                                <textarea class="form-control" name="operation" id="operation" rows="6" required="">{!! str_replace('<br />', '', $dataArr['productArr']->operation) !!}</textarea>
                            </div>
                        </div>


                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Features</label>
                                <textarea class="form-control" name="features" id="features" rows="6" required="">{!! str_replace('<br />', '', $dataArr['productArr']->features) !!}</textarea>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Special Options</label>
                                <textarea class="form-control" name="special_options" id="special_options" rows="6" required="">{!! str_replace('<br />', '', $dataArr['productArr']->special_options) !!}</textarea>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Technical Specifications</label>
                                <textarea class="form-control" name="technical_specifications" id="technical_specifications" rows="6"
                                    required="">{!! str_replace('<br />', '', $dataArr['productArr']->technical_specifications) !!}</textarea>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Applications</label>
                                <textarea class="form-control" name="applications" id="applications" rows="6" required="">{!! str_replace('<br />', '', $dataArr['productArr']->applications) !!}</textarea>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>brochure <small class="text-danger">*PDF size must be less than
                                        2MB</small></label>

                                <div class="custom-file mb-3">
                                    <input type="file" name="brochure" accept="application/pdf">
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Image <small class="text-danger">*Image size must be less than
                                        2MB</small></label>

                                <div class="custom-file mb-3">
                                    <input type="file" class="custom-file-input" id="gallery-photo-add" name="image[]"
                                        multiple="" accept="image/*">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 room-img">
                            @foreach ($dataArr['productArr']->getImages as $img)
                                <div id="remove_{{ $img->id }}">
                                    <img src="{{ asset('storage/product_image/') . '/' . $img->image_name }}">
                                    <span class="remove_img check-icon"
                                        onclick="removeImg('{!! $img->id !!}', '{!! $dataArr['productArr']->id !!}');"
                                        data-id="{{ $img->id }}" style="cursor: pointer;"><i
                                            class="fa fa-times"></i></span>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-lg-12 col-md-12 show-img gallery">
                        </div>
                    </div>
                    <button class="submit-btn subBtn" type="submit">Submit</button>
                </form>

            </div>
        </div>

    </div>
    <!-- Booking Status Section Start -->
@stop
@push('script')
    <script type="text/javascript">
        function removeImg(img_id, product_id) {
            $.post('{{ route('admin.product.img.remove') }}', {
                "img_id": img_id,
                "product_id": product_id,
                "_token": "{!! @csrf_token() !!}"
            }, function(response) {
                if (response.status == "success") {
                    $('#remove_' + img_id).hide();
                    $('.product-msg').show();

                    if (response.check == 0)
                        $('#gallery-photo-add').prop('required', 'true');

                    setTimeout(function() {
                        $('.product-msg').fadeOut('slow');
                    }, 4000);
                } else if (response.status == "error") {
                    $('.product-msg-err').show();
                    setTimeout(function() {
                        $('.product-msg-err').fadeOut('slow');
                    }, 4000);
                }
            });
        }

        $(function() {
            // Multiple images preview in browser
            var imagesPreview = function(input, placeToInsertImagePreview) {

                if (input.files) {
                    var filesAmount = input.files.length;

                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();

                        reader.onload = function(event) {
                            var new_html = '<img src="' + event.target.result + '">';
                            $('.gallery').append(new_html);
                            // $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                        }

                        reader.readAsDataURL(input.files[i]);
                    }
                }

            };

            $('#gallery-photo-add').on('change', function() {
                imagesPreview(this, 'div.gallery');
                $('.gallery').html('');
            });

            $('#productForm').click(function() {
                tinymce.triggerSave();
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $("#cat_id").on('change', () => {
                let cat_id = $('#cat_id option:selected').val();
                let url = "{{ route('admin.get.sub-cat', ':slug') }}"
                url = url.replace(":slug", cat_id);
                $.get(url, (response) => {
                    if (response.total > 0) {
                        $('#sub_cat_id').attr('required', true);
                    } else {
                        $('#sub_cat_id').attr('required', false);
                    }
                    let subcat = $('#sub_cat_id').empty();
                    let html = '<option value ="">Select Sub-Category</option>';

                    $.each(response.sub_cat, function(index, data) {
                        html += '<option value ="' + data.id + '">' + data.name +
                            '</option>';
                    })
                    $('#sub_cat_id').append(html);
                });

            });
        });
    </script>
    <script>
        $(document).ready(function() {

            $(document).on('click', '.remove', function() {
                $(this).closest('tr').remove();
            });

        });
    </script>
@endpush
