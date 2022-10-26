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
                <h2>Product Variation</h2>
                <h3 class="create-cat">
                    <a href="{{ route('admin.product') }}">Back</a>
                </h3>
            </div>

            <div class="product-msg" style="display: none;">
                <p class="alert alert-success"><strong>Product Variation Removed Successfully</strong></p>
            </div>
            <div class="product-msg-err" style="display: none;">
                <p class="alert alert-danger"><strong>Unable To Process Your Request</strong></p>
            </div>
            <div class="category-list-area">
                <form action="{{ route('admin.product.variant.update', $dataArr['product_id']) }}" method="POST"
                    id="productForm" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @foreach ($dataArr['productVariationArr'] as $productVariation)
                        @php
                            $var_opt = explode(',', $productVariation->variation_option_string);
                            $random_id = rand(111, 999);
                        @endphp
                        <div class="row" id="remove_{{ $productVariation->id }}">
                            <div class="col-lg-5 col-md-5">
                                <div class="form-group">
                                    <label>Variation
                                    </label>
                                    <select class="form-control variation_cls" name="variation_id[]"
                                        data-id="{{ $random_id }}" required="">
                                        <option value="">Select Variation</option>
                                        @foreach ($dataArr['variationArr'] as $variant)
                                            <option value="{{ $variant->id }}"
                                                {{ $variant->id == $productVariation->variation_id ? 'selected' : '' }}>
                                                {{ $variant->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5">
                                <div class="form-group" id="var_opt_div_{{ $random_id }}">
                                    <label>Variation Option</label>
                                    <select class="form-control chzn-select"
                                        name="variation_option_string[{{ $productVariation->variation_id }}][]" multiple>
                                        <option value="" disabled>Select Variation Option</option>
                                        @foreach (@$productVariation->getVarOpt as $VarOpt)
                                            <option value="{{ $VarOpt->id }}"
                                                {{ in_array($VarOpt->id, $var_opt) ? 'selected' : '' }}>
                                                {{ $VarOpt->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2">
                            <div class="form-group">
                                <label>&nbsp;</label>
                                <button style="display:block;" type="button" class="btn btn-danger btn-sm"
                                    onclick="removeVariant('{!! $productVariation->id !!}', {!! $dataArr['product_id'] !!});"><i
                                        class="fa fa-times"></i></button>
                            </div>
                                
                            </div>
                        </div>
                    @endforeach

                    <div class="row">
                        <div class="col-lg-5 col-md-5">
                            <div class="form-group">
                                <label>Variation
                                </label>
                                <select class="form-control variation_cls" name="variation_id[]" data-id="1"
                                    @if (empty($dataArr['productVariationArr'])) required="" @endif id="variation_id_1">
                                    <option value="">Select Variation</option>
                                    @foreach ($dataArr['variationArr'] as $variant)
                                        <option value="{{ $variant->id }}">{{ $variant->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5">
                            <div class="form-group" id="var_opt_div_1">
                                <label>Variation Option</label>
                                <select class="form-control" name="variation_option_string[][]">
                                    <option value="">Select Variation Option</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2">
                        <div class="form-group">
                                <label>&nbsp;</label>
                                <button style="display:block;" type="button" class="btn btn-success btn-sm" id="add_variant" data-id="1"><i
                                    class="fa fa-plus"></i></button>
                            </div>
                           
                            <input type="hidden" name="unique_id" id="unique_id" value="1" />
                        </div>
                    </div>

                    <div class="row mainS" id="variationDiv">
                    </div>
                    <button class="submit-btn subbtn" type="submit">Submit</button>
                </form>

            </div>
        </div>

    </div>
    <!-- Booking Status Section Start -->
@stop
@push('script')
    <script>
        $(document).ready(function() {

            $(document).on('click', '#add_variant', function() {
                var unique_id = $("#unique_id").val();
                unique_id++;
                $('#unique_id').val(unique_id);
                let url = "{{ route('admin.get.variation', ':slug') }}"
                url = url.replace(":slug", unique_id);
                $.get(url, (data) => {
                    $("#variationDiv").append(data);
                });

            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('change', '.variation_cls', function() {
                let variation_id = $(this).find('option:selected').val();
                let variation_data_id = $(this).attr("data-id");
                let url = "{{ route('admin.get.var.opt', ':slug') }}"
                url = url.replace(":slug", variation_id);
                $.get(url, (response) => {
                    $('#var_opt_div_' + variation_data_id).html(response);
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

        function removeVariant(product_variant_id, product_id) {
            $.post('{{ route('admin.product.variant.remove') }}', {
                "product_variant_id": product_variant_id,
                "product_id": product_id,
                "_token": "{!! @csrf_token() !!}"
            }, function(response) {
                if (response.status == "success") {
                    $('#remove_' + product_variant_id).remove();
                    $('.product-msg').show();

                    if (response.check == 0)
                        $('#variation_id_1').prop('required', 'true');

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
    </script>
@endpush
