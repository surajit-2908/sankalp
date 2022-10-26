@extends('layouts.banner_layout')
@section('content')

    @push('header')
        <!-- Banner Start here -->
        <div class="bannerMain">
            <div class="bannerbg">
                <div class="bannerImg">
                    @if ($banner['top']->image)
                        <img alt="Hero Fit" title="Hero Fit"
                            src="{{ asset('storage/content_image') . '/' . $banner['top']->image }}" />
                    @else
                        <img alt="Hero Fit" title="Hero Fit" src="{{ asset('assets/images/home-banner-bg.png') }}" />
                    @endif
                </div>
                @include('includes.frontend.menu')
                <div class="bannerText">
                    <div class="container">
                        <h1>{{ $banner['top']->title }} <span>{{ $banner['top']->sub_title }}</span></h1>
                        <p>
                            {!! $banner['top']->description !!}
                        </p>
                        <a class="shopBtn" href="{{ route('shop') }}">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    @endpush

    {{-- <div class="productSec">
        <div class="container">
            <h5 class="highLightText">Products</h5>
            <h2>Featured products</h2>
            <div class="productSecList">
                <div id="product_scroller" class="owl-carousel">
                    @foreach ($productArr as $product)
                        @php
                            $ratingCount = ratingCal($product->id)['ratingCount'];
                            if ($ratingCount) {
                                $ratingCountStr = $ratingCount . ($ratingCount > 1 ? ' reviews' : ' review');
                            } else {
                                $ratingCountStr = '';
                            }
                            $avgRating = round(ratingCal($product->id)['avgRating']);
                            $empty_star = 5 - round(ratingCal($product->id)['avgRating']);
                        @endphp
                        <div class="item" onclick="window.location='{{ route('product.detail', $product->slug) }}'">
                            <div class="productsCol">
                                <span class="imgBox"><img alt="icon"
                                        src="{{ asset('storage/product_image') . '/' . $product->image }}" /></span>
                                <div class="dFlex reviewsSec">
                                    <ul>
                                        @if ($avgRating)
                                            @for ($i = 0; $i < $avgRating; $i++)
                                                <li class="active"><i class="fa fa-star"></i></li>
                                            @endfor
                                            @for ($i = 0; $i < $empty_star; $i++)
                                                <li><i class="fa fa-star"></i></li>
                                            @endfor
                                        @endif
                                    </ul>
                                    <p>{{ $avgRating ? $ratingCountStr : @$product->getBrand->name }}</p>
                                </div>
                                <h3>{{ $product->title }}</h3>
                                <p class="price">${{ number_format($product->selling_offer_price, 2) }} /
                                    <del>${{ number_format($product->selling_price, 2) }}</del>
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div> --}}

    <div class="heroSec">
        <div class="heroSecBg">
            <div class="heroSecImg">
                @if ($banner['middle']->image)
                    <img alt="img"
                        src="{{ asset('storage/content_image') . '/' . $banner['middle']->image }}" />
                @else
                    <img alt="img" src="{{ asset('assets/images/home-banner3.png') }}" />
                @endif
            </div>
            <div class="heroTextSec">
                <div class="container">
                    <div class="heroTextcols">
                        <div>
                            <h2>{{ $banner['middle']->title }}</h2>
                            <h4>{{ $banner['middle']->sub_title }}</h4>
                            <p>
                                {!! $banner['middle']->description !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="aboutSec">
        <h5 class="highLightText pt50">About Me</h5>
        <div class="container">
            <div class="aboutSecMian">
                <div class="aboutSecMianCol">
                    <h2>About <span>Hero</span>fit</h2>
                    <p>
                        <strong>{{ $banner['bottom']->sub_title }}</strong>
                    </p>
                    <p>{!! $banner['bottom']->description !!}
                    </p>
                    <a class="shopBtn mt40" href="{{ route('about') }}">Learn more</a>
                </div>
                <div class="aboutSecMianCol">
                    <div class="abImgSec">
                        <div class="abImgCol">
                            @if ($banner['middle']->image)
                                <img alt="img"
                                    src="{{ asset('storage/content_image') . '/' . $banner['bottom']->image }}" />
                            @else
                                <img alt="img" src="{{ asset('assets/images/about-img2.jpg') }}" />
                            @endif
                        </div>
                        <div class="abImgCol mt80">
                            @if ($banner['middle']->image2)
                                <img alt="img"
                                    src="{{ asset('storage/content_image') . '/' . $banner['bottom']->image2 }}" />
                            @else
                                <img alt="img" src="{{ asset('assets/images/about-img3.jpg') }}" />
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    @if (count($onlineTrainingArr))
        <div class="onlineTraningSec">
            <h5 class="highLightText pt50">Online Training</h5>
            <div class="container">
                <h2>Online training<span></span> We aim to transform</h2>

                <div class="otslideRow">
                    <div id="training_scroller" class="owl-carousel">
                        @foreach ($onlineTrainingArr as $onlineTraining)
                            <div class="item">
                                <div class="otslideCol">
                                    <img alt="icon"
                                        src="{{ asset('storage/online_training_file') . '/' . $onlineTraining->image }}" />
                                    <div class="playSec"
                                        data-video="{{ asset('storage/online_training_file') . '/' . $onlineTraining->video }}">
                                        <img alt="icon" src="{{ asset('assets/images/play-icon.png') }}" />
                                        <p>{{ $onlineTraining->title }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
    {{-- @include('includes.frontend.testimonial') --}}

@stop

@push('modal')
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog onTraingPop" role="document">
            <div class="modal-content">
                <div class="modal-header" style="padding:10px;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="videoSrc">
                    {{-- <video width="250" height="150" controls>
                        <source id="videoSrc"
                            src="{{ asset('storage/online_training_file/VID-20210716-WA0002.mp4') }}">
                    </video> --}}
                    {{-- <iframe height="300" width="100%" id="iframeUtb" src="">
                    </iframe> --}}
                </div>
            </div>
        </div>
    </div>
@endpush

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".playSec").click(function() {
                var video_html = '<video width="400" height="300" controls><source src="' + $(this).data(
                    'video') + '"></video>';
                $('#videoSrc').append(video_html);
                $('#myModal').modal('toggle');

                // $('#videoSrc').attr('src', $(this).data('video'));
            })
            $("#myModal").on('hidden.bs.modal', function(e) {
                $('#videoSrc').html('');
                // $("#myModal source").attr("src", $("#myModal source").attr("src"));
            });
        })
    </script>
@endpush
