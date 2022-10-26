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
                                        <div class="prdctImgClm" onclick="window.location='{{ route('online.training') }}'">
                                            <img src="{{ asset('storage/online_training_file') . '/' . $rating->getOrderDetail->getOnlineTrainingDetail->image }}"
                                                alt="">
                                        </div>
                                        <div class="prdctDscrptionClm">
                                            <h3>{{ $rating->getOrderDetail->getOnlineTrainingDetail->title }}</h3>
                                            <h4><span>{{ $rating->rating }}<i class="fa fa-star"
                                                        aria-hidden="true"></i></span>
                                                {{ $rating->title }}
                                            </h4>
                                            <p>{{ $rating->description }}</p>
                                            <p class="reviewAction">
                                                <a
                                                    href="{{ route('user.add.online.training.rating.review', [$rating->order_number, $rating->getOrderDetail->getOnlineTrainingDetail->id]) }}">Edit</a>
                                                <a href="{{ route('user.remove.online.training.rating', $rating->id) }}"
                                                    class="delete-confirm">Delete</a>
                                            </p>
                                        </div>
                                        <div class="likeDislikeClm">
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
