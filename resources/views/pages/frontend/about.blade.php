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
                        <img alt="Hero Fit" title="Hero Fit" src="{{ asset('assets/images/about-banner2.png') }}" />
                    @endif
                </div>
                @include('includes.frontend.menu')
                <div class="bannerText aboutBanner">
                    <div class="container">
                        <h1>{{ $banner['top']->title }} <span>{{ $banner['top']->sub_title }}</span></h1>
                        <p>{!! $banner['top']->description !!}</p>
                    </div>
                </div>
            </div>
        </div>
    @endpush

    <div class="aboutpSec">
        <div class="container">
            <div class="aboutpRow">
                <div class="aboutpCol">
                    @if ($banner['middle']->image)
                        <img alt="img"
                            src="{{ asset('storage/content_image') . '/' . $banner['middle']->image }}" />
                    @else
                        <img alt="img" src="{{ asset('assets/images/about-img-col.jpg') }}" />
                    @endif
                </div>
                <div class="aboutpCol">
                    <h5 class="highLightText noWrap">About Me</h5>
                    <h2>About <span>787</span> fitness</h2>
                    <p><strong>{{ $banner['middle']->sub_title }}</strong></p>
                    <p>{!! $banner['middle']->description !!}</p>
                </div>
            </div>

            <div class="text-center abtext">
                <h2>{{ $banner['bottom']->title }}</h2>
                <p class="pGaplr"><strong>{{ $banner['bottom']->sub_title }}</strong> </p>
                <p>{!! $banner['bottom']->description !!}</p>
            </div>

        </div>
    </div>



    {{-- <div class="featuredSec">
        <h5 class="highLightText pt50">As seen on</h5>
        <div class="container">
            <h2>Featured in</h2>
            <ul>
                <li><img alt="img" src="{{ asset('assets/images/featured-logo1.png') }}" /></li>
                <li><img alt="img" src="{{ asset('assets/images/featured-logo2.png') }}" /></li>
                <li><img alt="img" src="{{ asset('assets/images/featured-logo3.png') }}" /></li>
                <li><img alt="img" src="{{ asset('assets/images/featured-logo4.png') }}" /></li>
                <li><img alt="img" src="{{ asset('assets/images/featured-logo5.png') }}" /></li>
                <li><img alt="img" src="{{ asset('assets/images/featured-logo6.png') }}" /></li>
                <li><img alt="img" src="{{ asset('assets/images/featured-logo7.png') }}" /></li>
                <li><img alt="img" src="{{ asset('assets/images/featured-logo8.png') }}" /></li>
                <li><img alt="img" src="{{ asset('assets/images/featured-logo9.png') }}" /></li>
                <li><img alt="img" src="{{ asset('assets/images/featured-logo10.png') }}" /></li>
                <li><img alt="img" src="{{ asset('assets/images/featured-logo11.png') }}" /></li>
                <li><img alt="img" src="{{ asset('assets/images/featured-logo12.png') }}" /></li>
            </ul>
        </div>
    </div> --}}

    {{-- @include('includes.frontend.testimonial') --}}
@stop
