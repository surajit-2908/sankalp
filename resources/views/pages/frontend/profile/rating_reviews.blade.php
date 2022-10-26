@extends('layouts.layout')
@section('content')


    <div class="ratingReviewPage">
        <div class="container">
            <h1>Rate and Review</h1>
            <div class="ratingReviewBdyPrt">
                <div class="ratingArea">
                    <div class="presentRate">
                        <h2>Rate this product</h2>
                        @for ($i = 1; $i <= 5; $i++)
                            @if (!@$rating->rating && $i == 1)
                                <i class="fa fa-star rating-cls rating-star" aria-hidden="true" id="rating_{{ $i }}"
                                    data-id="{{ $i }}"></i>
                            @else
                                <i class="fa fa-star rating-cls {{ @$rating->rating >= $i ? 'rating-star' : '' }}"
                                    aria-hidden="true" id="rating_{{ $i }}" data-id="{{ $i }}"></i>
                            @endif
                        @endfor
                    </div>
                    <div class="previousRate">
                        <div class="previousRateTextClm">
                            <h2>{{ $product->title }}</h2>
                            <p><span>{{ ratingCal($product->id)['avgRating'] }} <i class="fa fa-star"
                                        aria-hidden="true"></i></span>{{ ratingCal($product->id)['ratingCount'] }}
                            </p>
                        </div>
                        <div class="previousRateImgClm"
                            onclick="window.location='{{ route('product.detail', $product->slug) }}'">
                            <img src="{{ asset('storage/product_image') . '/' . $product->image }}" alt="">
                        </div>
                    </div>
                </div>

                <div class="reviewArea">
                    <h2>Review this product</h2>
                    <form method="post" action="{{ route('user.save.rating', [$booking_number, $product->id]) }}"
                        class="reviewFormArea" id="myform">
                        <div class="formGroup">
                            <textarea class="formControl" placeholder="Description" name="description">{{ @$rating->description }}</textarea>
                        </div>
                        <div class="formGroup">
                            {{ csrf_field() }}
                            <input type="hidden" name="rating" id="rating"
                                value="{{ @$rating->rating ? $rating->rating : '1' }}" />
                            <input class="formControl" placeholder="Title (optional)" type="text" name="title"
                                value="{{ @$rating->title }}" />
                        </div>
                        <label id="description-error" class="error" for="description" style="display: none;">Please enter
                            description</label>
                        <div class="dFlex">
                            <button class="pinkBtn" type="submit">Submit</button>
                            {{-- <i class="fa fa-camera" aria-hidden="true"></i> --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
    <script>
        $("#myform").validate({
            rules: {
                description: {
                    required: true
                }
            },
            messages: {
                description: "Description cannot be empty"
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $(".rating-cls").on('click', function() {
                $(".rating-cls").removeClass("rating-star")
                const rating = $(this).data("id");
                for (let i = 1; i <= rating; i++) {
                    $(`#rating_${i}`).addClass("rating-star")
                }
                $("#rating").val(rating);
            });
        })
    </script>
@endpush
