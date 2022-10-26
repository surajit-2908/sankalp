@extends('layouts.admin-dashboard')
@section('content')
    <div class="admin-body-area">
        <!-- Booking Status Section Start -->
        <div class="booking-status-sec category-list-sec">
            <div class="category-list-hdn">
                <h2>Product Faq</h2>
                <h3 class="create-cat">
                    <a href="{{ route('admin.product') }}">Back</a>
                </h3>
            </div>

            <div class="product-msg" style="display: none;">
                <p class="alert alert-success"><strong>Product Faq Removed Successfully</strong></p>
            </div>
            <div class="product-msg-err" style="display: none;">
                <p class="alert alert-danger"><strong>Unable To Process Your Request</strong></p>
            </div>
            <div class="category-list-area">
                <form action="{{ route('admin.product.faq.update', $dataArr['product_id']) }}" method="POST"
                    id="productForm" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @foreach ($dataArr['productFaqArr'] as $productFaq)
                        <div class="row" id="remove_{{ $productFaq->id }}">
                            <div class="col-lg-5 col-md-5">
                                <div class="form-group">
                                    <label>Question</label>
                                    <input type="text" class="form-control" value="{{ $productFaq->question }}"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5">
                                <div class="form-group">
                                    <label>Answer</label>
                                    <input type="text" class="form-control" value="{{ $productFaq->answer }}" disabled>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <button style="display:block;" type="button" class="btn btn-danger btn-sm"
                                        onclick="removeFaq('{!! $productFaq->id !!}', {!! $dataArr['product_id'] !!});"><i
                                            class="fa fa-times"></i></button>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="row">
                        <div class="col-lg-5 col-md-5">
                            <div class="form-group">
                                <label>Question</label>
                                <input type="text" name="question[]" class="form-control"
                                    @if (!count($dataArr['productFaqArr'])) required="" @endif id="question_id_1">
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5">
                            <div class="form-group">
                                <label>Answer</label>
                                <input type="text" name="answer[]" class="form-control"
                                    @if (!count($dataArr['productFaqArr'])) required="" @endif id="answer_id_1">
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2">
                            <div class="form-group">
                                <label>&nbsp;</label>
                                <button style="display:block;" type="button" class="btn btn-success btn-sm"
                                    id="add_variant" data-id="1"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>

                        <div id="main-faq" class="mainS" style="display: none;">
                            <div class="close-dive showSect">
                                <div class="col-lg-5 col-md-5">
                                    <div class="form-group">
                                        <label>Question</label>
                                        <input type="text" name="question[]" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-5">
                                    <div class="form-group">
                                        <label>Answer</label>
                                        <input type="text" name="answer[]" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <button style="display:block;" type="button" class="btn btn-danger btn-sm remove">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="faqDiv">
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
                if (!$('#main-faq').is(':visible')) {
                    $("#main-faq").show();
                } else {
                    let html = $("#main-faq").clone();
                    $("#faqDiv").append(html);
                }
            });

            $(document).on('click', '.remove', function() {
                $(this).closest('.close-dive').remove();
            });
        });
    </script>

    <script>
        function removeFaq(product_faq_id, product_id) {
            $.post('{{ route('admin.product.faq.remove') }}', {
                "product_faq_id": product_faq_id,
                "product_id": product_id,
                "_token": "{!! @csrf_token() !!}"
            }, function(response) {
                if (response.status == "success") {
                    $('#remove_' + product_faq_id).remove();
                    $('.product-msg').show();

                    if (response.check == 0) {
                        $('#question_id_1').prop('required', 'true');
                        $('#answer_id_1').prop('required', 'true');
                    }

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
