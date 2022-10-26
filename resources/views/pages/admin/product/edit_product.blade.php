@extends('layouts.admin-dashboard')
@push('links')
    <link rel="stylesheet" href="{{ asset('chosen/docsupport/prism.css') }}">
    <link rel="stylesheet" href="{{ asset('chosen/chosen.css') }}">
@endpush
@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec category-list-sec">
            <div class="category-list-hdn">
                <h2>Edit Product</h2>
                <h3 class="create-cat">
                    <a href="{{ route('admin.product') }}">Back</a>
                </h3>
            </div>

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
                                <label>Brand
                                </label>
                                <select class="form-control" name="brand_id" required="">
                                    <option value="">Select Brand</option>
                                    @foreach ($dataArr['brandArr'] as $brand)
                                        <option value="{{ $brand->id }}"
                                            {{ $brand->id == $dataArr['productArr']->brand_id ? ' selected="selected"' : '' }}>
                                            {{ $brand->name }}</option>
                                    @endforeach
                                </select>
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
                        </div>
                        {{-- <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Short Description</label>
                                <input type="text" name="short_description" class="form-control"
                                    value="{{ $dataArr['productArr']->short_description }}" required>
                            </div>
                        </div> --}}

                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="long_description" rows="6" required="">{!! str_replace('<br />', '', $dataArr['productArr']->long_description) !!}</textarea>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Feautres <small class="text-danger">*Add separated by comma</small></label>
                                <textarea class="form-control" name="feautres" rows="6" required="">{!! str_replace('<br />', '', $dataArr['productArr']->feautres) !!}</textarea>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Shopping & Returns</label>
                                <textarea class="form-control" name="shopping_returns" rows="6" required="">{!! str_replace('<br />', '', $dataArr['productArr']->shopping_returns) !!}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Banner Image <small class="text-danger">*Image size must be less than
                                        2MB</small></label>
                                <div class="custom-file mb-3">
                                    <input type="file" class="custom-file-input" name="banner_image" accept="image/*"
                                        onchange="readURL(this);">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 show-img">
                            <img id="showImg"
                                src="{{ asset('storage/product_image/') . '/' . $dataArr['productArr']->image }}">
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Gallery Images <small class="text-danger">*Image size must be less than
                                        2MB</small></label>

                                <div class="custom-file mb-3">
                                    <input type="file" class="custom-file-input" id="gallery-photo-add"
                                        name="image[]" multiple="" accept="image/*">
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
                                {{-- <div id="remove_{{ $img->id }}">
                                    <img src="{{ asset('storage/product_image/') . '/' . $img->image_name }}">
                                    <span class="remove_img "
                                        onclick="removeImg('{!! $img->id !!}', '{!! $dataArr['productArr']->id !!}');"
                                        data-id="{{ $img->id }}" style="cursor: pointer;">remove</span>
                                </div> --}}
                            @endforeach
                        </div>
                        <div class="col-lg-12 col-md-12 show-img gallery">
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

                    $.each(response, function(index, data) {
                        html += '<option value ="' + data.id + '">' + data
                            .name +
                            '</option>';
                    })
                    $('#sub_cat_id').append(html);
                });

            });
        });
    </script>
    <script src="{{ asset('chosen/chosen.jquery.js') }}" type="text/javascript"></script>
    <script src="{{ asset('chosen/docsupport/prism.js') }}" type="text/javascript" charset="utf-8"></script>
    <script src="{{ asset('chosen/docsupport/init.js') }}" type="text/javascript" charset="utf-8"></script>
    <script>
        $(function() {
            $(".chzn-select").chosen({
                allow_single_deselect: true
            });
        });
        $(document).ready(function() {

            $(document).on('click', '.remove', function() {
                $(this).closest('tr').remove();
            });

        });
    </script>
@endpush
