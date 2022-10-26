@extends('layouts.layout')
@section('content')

    <div class="afterLoginBodyPrt">
        <div class="container">
            @include('includes.frontend.message')
            <div class="afterLoginBodyRow">
                @include('includes.frontend.profile-sidebar')

                <div class="afterLoginRightPanel">
                    <div class="reviewRatingBdyPrt">
                        <div class="orderFlex">
                            <h2>My Reviews <span>({{ count($ratings) }})</span></h2>
                            <div class="orderLinktext">
                                <a href="{{ route('user.my.rating.review') }}"
                                    @if (Route::is('user.my.rating.review')) class="active" @endif>Item
                                    Reviews</a>
                                <a href="{{ route('user.online.training.rating.review') }}"
                                    @if (Route::is('user.online.training.rating.review')) class="active" @endif>Online Traning Reviews</a>
                            </div>
                        </div>

                        <div class="reviewRatingListArea">
                            <ul>
                                @forelse ($ratings as $rating)
                                    <li>
                                        <div class="prdctImgClm"
                                            onclick="window.location='{{ route('product.detail', $rating->getProductDetail->slug) }}'">
                                            <img src="{{ asset('storage/product_image') . '/' . $rating->getProductDetail->image }}"
                                                alt="">
                                        </div>
                                        <div class="prdctDscrptionClm">
                                            <h3>{{ $rating->getProductDetail->title }}</h3>
                                            <h4><span>{{ $rating->rating }}<i class="fa fa-star"
                                                        aria-hidden="true"></i></span>
                                                {{ $rating->title }}
                                            </h4>
                                            <p>{{ $rating->description }}</p>
                                            <p class="reviewAction">
                                                <a
                                                    href="{{ route('user.rating.review', [$rating->order_number, $rating->getProductDetail->slug]) }}">Edit</a>
                                                <a href="{{ route('user.remove.rating', $rating->id) }}"
                                                    class="delete-confirm">Delete</a>
                                                <a href="javascript:void(0)">Share</a>
                                            </p>
                                        </div>
                                        <div class="likeDislikeClm">
                                            {{-- <p class="likeCount"><i class="fa fa-thumbs-up" aria-hidden="true"></i> 0</p>
                                            <p class="disLikeCount"><i class="fa fa-thumbs-down" aria-hidden="true"></i> 0
                                            </p> --}}
                                        </div>
                                    </li>
                                @empty
                                    <li>No reviews</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@push('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript">
        $('.delete-confirm').on('click', function(event) {
            event.preventDefault();
            const url = $(this).attr('href');
            swal({
                title: 'Are you sure?',
                text: 'This rating will be permanantly deleted!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    window.location.href = url;
                }
            });
        });
    </script>
@endpush
