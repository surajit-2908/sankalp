@extends('layouts.admin-dashboard')
@section('content')
    <div class="dFlx spaceBet">
        <h1 class="pageTitle mb20">Add product</h1>
        <a class="addNew" href="{{ route('admin.product') }}">Back</a>
    </div>
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec category-list-sec">

            <div class="category-list-area">
                <form action="{{ route('admin.product.insert') }}" method="POST" id="productForm"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Category
                                </label>
                                <select class="form-control" name="cat_id" id="cat_id" required="">
                                    <option value="">Select Category</option>
                                    @foreach ($dataArr['parentCategoryArr'] as $pCat)
                                        <option value="{{ $pCat->id }}">{{ $pCat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Sub-Category
                                </label>
                                <select class="form-control" name="sub_cat_id" id="sub_cat_id">
                                    <option value="">Select Sub-Category</option>
                                </select>
                            </div>
                        </div>
                        {{-- <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Available Quantity</label>
                                <input type="number" name="quantity" class="form-control" min="0" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Product Price</label>
                                <input type="number" name="selling_price" class="form-control" min="0" step=".01"
                                    required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Selling Price</label>
                                <input type="number" name="selling_offer_price" class="form-control" min="0" step=".01"
                                    required>
                            </div>
                        </div> --}}

                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description" rows="6" required=""></textarea>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Images <small class="text-danger">*Image size must be less than
                                        2MB</small></label>

                                <div class="custom-file mb-3">
                                    <input type="file" class="custom-file-input" id="gallery-photo-add" name="image[]"
                                        multiple="" accept="image/*" required>
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>

                            </div>
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
@endpush
